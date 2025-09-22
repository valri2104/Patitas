<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class OrderItemController extends Controller
{
    /**
     * Display a listing of the order items.
     */
    public function index(): View
    {
        $viewData = [];
        $viewData['orderItems'] = OrderItem::with('product')->get();
        return view('orderItem.index')->with('viewData', $viewData);
    }

    /**
     * Display the specified order item.
     */
    public function show(int $id): View
    {
        $viewData = [];
        $viewData['orderItem'] = OrderItem::with('product')->find($id);
        return view('orderItem.show')->with('viewData', $viewData);
    }
}
