<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    // Historial de pedidos del usuario
    public function index()
    {
        $orders = Order::where('user_id', auth()->id())->orderByDesc('date_time')->get();
        return view('order.index', compact('orders'));
    }
    // Mostrar detalle de un pedido
    public function show($id)
    {
        $order = Order::with('orderItems.product')->findOrFail($id);
        // Solo el dueño o admin puede ver
        if (auth()->id() !== $order->getUserId() && !(auth()->user() && auth()->user()->is_admin)) {
            abort(403);
        }
        return view('order.show', compact('order'));
    }
    // Mostrar formulario para crear pedido
    public function create()
    {
        $products = Product::where('stock', '>', 0)->get();
        return view('order.create', compact('products'));
    }

    // Guardar pedido
    public function store(Request $request)
    {
        $request->validate([
            'delivery_address' => 'required|string|max:255',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();
        try {
            $order = new Order();
            $order->setUserId(Auth::id());
            $order->setDateTime(now()->toDateTimeString());
            $order->setStatus('pendiente');
            $order->setDeliveryAddress($request->input('delivery_address'));
            $order->setNotes($request->input('notes'));
            $order->setTotal(0); // Se calcula después
            $order->save();

            $total = 0;
            foreach ($request->input('items') as $item) {
                $product = Product::findOrFail($item['product_id']);
                $quantity = (int) $item['quantity'];
                $unitPrice = $product->getPrice();
                $subtotal = $unitPrice * $quantity;
                $total += $subtotal;

                $orderItem = new OrderItem();
                $orderItem->setOrderId($order->getId());
                $orderItem->setProductId($product->getId());
                $orderItem->setQuantity($quantity);
                $orderItem->setUnitPrice($unitPrice);
                $orderItem->setCustomizable(false); // Por defecto
                $orderItem->save();
            }
            $order->setTotal($total);
            $order->save();

            DB::commit();
            return redirect()->route('order.show', $order->getId())
                ->with('success', 'Pedido creado correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Error al crear el pedido: ' . $e->getMessage()]);
        }
    }
}
