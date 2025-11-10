<?php

namespace App\Http\Controllers;

use App\Http\Requests\Cart\AddRequest;
use App\Http\Requests\Cart\PurchaseRequest;
use App\Http\Requests\Cart\RemoveRequest;
use App\Http\Requests\Cart\UpdateQuantityRequest;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Utils\CartManager;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CartController extends Controller
{
    public function index(): View
    {
        $viewData          = [];
        $viewData['title'] = __('cart.title');
        $cartProducts      = CartManager::getCartProducts();

        $cartItems   = [];
        $totalAmount = 0;

        foreach ($cartProducts as $item) {
            $product  = $item['product'];
            $quantity = $item['quantity'];
            $subtotal = $product->getPrice() * $quantity;
            $totalAmount += $subtotal;

            $cartItems[] = [
                'product'               => $product,
                'quantity'              => $quantity,
                'subtotal'              => $subtotal,
                'subtotalFormatted'     => number_format($subtotal, 2),
                'productPriceFormatted' => number_format($product->getPrice(), 2),
            ];
        }

        $viewData['cartItems'] = $cartItems;
        // Also expose under expected key name for strict view rules
        $viewData['cartProducts']         = $cartItems;
        $viewData['totalAmount']          = $totalAmount;
        $viewData['totalAmountFormatted'] = number_format($totalAmount, 2);

        // Prefill address for authenticated users
        $prefilledAddress = '';

        if (Auth::check()) {
            $user = Auth::user();

            if ($user instanceof User) {
                $prefilledAddress = $user->getAddress() ?? '';
            }
        }
        $viewData['prefilledAddress'] = $prefilledAddress;

        return view('cart.index')->with('viewData', $viewData);
    }

    public function updateQuantity(UpdateQuantityRequest $request): RedirectResponse
    {
        $request->validated();
        CartManager::updateQuantity($request->input('product_id'), $request->input('quantity'));

        return Redirect::route('cart.index');
    }

    public function add(AddRequest $request): RedirectResponse
    {
        $request->validated();
        CartManager::addProduct($request->input('product_id'), $request->input('quantity'));

        return Redirect::route('cart.index');
    }

    public function remove(RemoveRequest $request): RedirectResponse
    {
        $request->validated();
        CartManager::removeProduct($request->input('product_id'));

        return Redirect::route('cart.index');
    }

    public function purchase(PurchaseRequest $request): RedirectResponse
    {
        if (! Auth::check()) {
            return Redirect::route('login')->with('error', __('cart.messages.login_required'));
        }

        $cartProducts = CartManager::getCartProducts();

        if (empty($cartProducts)) {
            return Redirect::route('cart.index')->with('error', __('cart.messages.empty_cart'));
        }

        $validatedData = $request->validated();

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

            $order = new Order;
            $order->setUserId(Auth::id());
            $order->setOrderDate(now());
            $order->setStatus('pending');
            $order->setTotal(0);
            $order->setDeliveryAddress($validatedData['delivery_address']);
            $order->save();

            foreach ($cartProducts as $cartProduct) {
                $product  = $cartProduct['product'];
                $quantity = $cartProduct['quantity'];

                $orderItem = new OrderItem;
                $orderItem->setOrderId($order->getId());
                $orderItem->setProductId($product->getId());
                $orderItem->setQuantity($quantity);
                $orderItem->setUnitPrice($product->getPrice());
                $orderItem->save();

                $product->decreaseStock($quantity);
                $product->save();
            }

            $order->setTotal($order->calculateTotal());
            $order->save();

            CartManager::clearCart();

            DB::commit();

            return Redirect::route('order.show', $order->getId())
                ->with('success', __('cart.messages.purchase_successful'));
        } catch (Exception $e) {
            DB::rollBack();

            return Redirect::route('cart.index')
                ->with('error', __('cart.messages.purchase_failed'));
        }
    }

    public function purchaseConfirmation(): View
    {
        $viewData              = [];
        $viewData['title']     = __('cart.purchase_title');
        $viewData['orderId']   = session('orderId');
        $viewData['orderDate'] = now()->format('d/m/Y H:i');

        return view('cart.purchase')->with('viewData', $viewData);
    }
}
