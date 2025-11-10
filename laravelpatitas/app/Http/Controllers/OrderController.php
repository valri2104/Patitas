<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(): View|RedirectResponse
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()
                ->route('login')
                ->withErrors('Debes iniciar sesión para ver tus pedidos.');
        }

        $viewData = [];
        $viewData['title'] = __('orders.index.title');
        $viewData['orders'] = Order::with(['orderItems.product'])
            ->where('user_id', $user->getId())
            ->orderByDesc('orderDate')
            ->get();

        return view('order.index')->with('viewData', $viewData);
    }

    public function show(int $id): View|RedirectResponse
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()
                ->route('login')
                ->withErrors('Debes iniciar sesión para ver este pedido.');
        }

        $order = Order::with(['orderItems.product'])
            ->where('id', $id)
            ->where('user_id', $user->getId())
            ->firstOrFail();

        $viewData = [];
        $viewData['title'] = __('orders.show.title', ['id' => $order->getId()]);
        $viewData['order'] = $order;

        return view('order.show')->with('viewData', $viewData);
    }
}
