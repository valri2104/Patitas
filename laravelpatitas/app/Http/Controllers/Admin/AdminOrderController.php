<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Enums\Status;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminOrderController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index(Request $request): View
    {
        $selectedStatus = $request->query('status');

        $viewData = [];
        $viewData['title'] = __('admin.orders.index.title');
        $viewData['subtitle'] = __('admin.orders.index.subtitle');
        $viewData['statuses'] = collect(Status::cases())->map(fn($s) => $s->value);
        $viewData['selectedStatus'] = $selectedStatus;

        $query = Order::with('user')->orderByDesc('orderDate');

        if ($selectedStatus && $viewData['statuses']->contains($selectedStatus)) {
            $query->where('status', $selectedStatus);
        }

        $viewData['orders'] = $query->get();

        return view('admin.order.index', $viewData);
    }

    public function show(int $id): View
    {
        $order = Order::with(['user', 'orderItems.product'])->findOrFail($id);

        $viewData             = [];
        $viewData['title']    = __('admin.orders.show.title', ['id' => $order->getId()]);
        $viewData['subtitle'] = __('admin.orders.show.subtitle');
        $viewData['order']    = $order;
        $viewData['status'] = $order->getStatus();
        $viewData['total'] = $order->calculateTotal();
        $viewData['statuses'] = collect(Status::cases())->map(fn($s) => $s->value);

        return view('admin.order.show')->with('viewData', $viewData);
    }

    public function updateStatus(Request $request, int $id): RedirectResponse
    {
        $allowedStatuses = array_map(fn($status) => $status->value, Status::cases());

        $validatedData = $request->validate([
            'status' => 'required|in:' . implode(',', $allowedStatuses),
        ]);

        $order = Order::findOrFail($id);
        $order->setStatus($validatedData['status']);
        $order->save();

        return redirect()->route('admin.order.show', $order->getId())
            ->with('success', __('admin.orders.messages.status_updated'));
    }


}
