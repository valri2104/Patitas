<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(): View
    {
        $viewData           = [];
        $viewData['title']  = __('orders.index.title');
        $viewData['orders'] = Order::with(['orderItems.product'])
            ->where('user_id', Auth::user()->getId())
            ->orderByDesc('orderDate')
            ->get();

        return view('order.index')->with('viewData', $viewData);
    }

    public function show(int $id): View
    {
        $order = Order::with(['orderItems.product'])
            ->where('id', $id)
            ->where('user_id', Auth::user()->getId())
            ->firstOrFail();

        $viewData          = [];
        $viewData['title'] = __('orders.show.title', ['id' => $order->getId()]);
        $viewData['order'] = $order;

        return view('order.show')->with('viewData', $viewData);
    }
}
