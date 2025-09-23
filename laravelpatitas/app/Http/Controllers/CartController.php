<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Utils\CartManager;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CartController extends Controller
{
    /**
     * Display the cart contents.
     */
    public function index(): View
    {
        $viewData                 = [];
        $viewData['title']        = __('cart.title');
        $viewData['cartProducts'] = CartManager::getCartProducts();

        return view('cart.index')->with('viewData', $viewData);
    }

    /**
     * Update the quantity of a product in the cart.
     */
    public function updateQuantity(Request $request): RedirectResponse
    {
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'quantity'   => 'required|integer|min:1',
        ]);
        CartManager::updateQuantity($request->input('product_id'), $request->input('quantity'));

        return Redirect::route('cart.index');
    }

    /**
     * Add a product to the cart.
     */
    public function add(Request $request): RedirectResponse
    {
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'quantity'   => 'required|integer|min:1',
        ]);
        CartManager::addProduct($request->input('product_id'), $request->input('quantity'));

        return Redirect::route('cart.index');
    }

    /**
     * Remove a product from the cart.
     */
    public function remove(Request $request): RedirectResponse
    {
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
        ]);
        CartManager::removeProduct($request->input('product_id'));

        return Redirect::route('cart.index');
    }

    /**
     * Purchase the products in the cart.
     */
    public function purchase(Request $request): RedirectResponse
    {
        // Validate user authentication
        if (! Auth::check()) {
            return Redirect::route('login')->with('error', __('cart.messages.login_required'));
        }

        $cartProducts = CartManager::getCartProducts();

        // Validate cart is not empty
        if (empty($cartProducts)) {
            return Redirect::route('cart.index')->with('error', __('cart.messages.empty_cart'));
        }

        // Validate delivery address
        $request->validate([
            'delivery_address' => 'required|string|min:10|max:500',
        ]);

        // Validate stock availability before processing
        foreach ($cartProducts as $cartProduct) {
            $product  = $cartProduct['product'];
            $quantity = $cartProduct['quantity'];

            if ($product->getStock() < $quantity) {
                return Redirect::route('cart.index')
                    ->with('error', __('cart.messages.insufficient_stock', ['product' => $product->getName()]));
            }
        }

        try {
            DB::beginTransaction();

            // Create the order
            $order = new Order;
            $order->setUserId(Auth::id());
            $order->setOrderDate(now());
            $order->setStatus('pending');
            $order->setTotal(0); // Will be calculated after adding items
            $order->setDeliveryAddress($request->input('delivery_address'));
            $order->save();

            $totalAmount = 0;

            // Create order items and update stock
            foreach ($cartProducts as $cartProduct) {
                $product  = $cartProduct['product'];
                $quantity = $cartProduct['quantity'];

                // Create order item
                $orderItem = new OrderItem;
                $orderItem->setOrderId($order->getId());
                $orderItem->setProductId($product->getId());
                $orderItem->setQuantity($quantity);
                $orderItem->setUnitPrice($product->getPrice());
                $orderItem->save();

                // Update product stock
                $product->decreaseStock($quantity);
                $product->save();

                // Add to total
                $totalAmount += $orderItem->calculateSubtotal();
            }

            // Update order total
            $order->setTotal($totalAmount);
            $order->save();

            // Clear cart only if everything was successful
            CartManager::clearCart();

            DB::commit();

            return Redirect::route('cart.purchase')
                ->with('success', __('cart.messages.purchase_successful'))
                ->with('orderId', $order->getId());

        } catch (\Exception $e) {
            DB::rollBack();

            return Redirect::route('cart.index')
                ->with('error', __('cart.messages.purchase_failed'));
        }
    }

    /**
     * Display the purchase confirmation page.
     */
    public function purchaseConfirmation(): View
    {
        $viewData            = [];
        $viewData['title']   = __('cart.purchase_title');
        $viewData['orderId'] = session('orderId');

        return view('cart.purchase')->with('viewData', $viewData);
    }
}
