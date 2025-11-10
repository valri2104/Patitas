@extends('layouts.admin')

@section('title', __('admin.orders.show.title', ['id' => $viewData['order']->getId()]))
@section('subtitle', __('admin.orders.show.subtitle'))

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <a href="{{ route('admin.order.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>{{ __('admin.orders.show.back') }}
            </a>
            <a href="#" class="btn btn-outline-primary">
                <i class="fas fa-print me-2"></i>{{ __('admin.orders.show.print') }}
            </a>
        </div>

        <div class="card shadow-sm mb-4">
            <div class="card-body">
                @php
                    $order = $viewData['order'];
                    $user = $order->getUser();
                    $status = $order->getStatus();
                    $statusConfigs = [
                        'pending' => ['class' => 'bg-warning text-dark', 'style' => ''],
                        'confirmed' => ['class' => 'bg-primary', 'style' => ''],
                        'shipped' => ['class' => 'text-white', 'style' => 'background-color: #6f42c1;'],
                        'delivered' => ['class' => 'bg-success', 'style' => ''],
                        'cancelled' => ['class' => 'bg-danger', 'style' => ''],
                    ];
                    $statusConfig = $statusConfigs[$status] ?? ['class' => 'bg-secondary', 'style' => ''];
                @endphp
                <div class="row g-4">
                    <div class="col-lg-4">
                        <div class="border rounded p-3 h-100">
                            <h2 class="h5 text-muted mb-3">
                                <i class="fas fa-user me-2"></i>{{ __('admin.orders.show.customer') }}
                            </h2>
                            <p class="fw-bold mb-1">{{ $user ? $user->getName() : __('admin.orders.index.unknown_customer') }}</p>
                            <p class="text-muted mb-0">{{ $user ? $user->getEmail() : __('admin.orders.show.email_unavailable') }}</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="border rounded p-3 h-100">
                            <h2 class="h5 text-muted mb-3">
                                <i class="fas fa-info-circle me-2"></i>{{ __('admin.orders.show.order_details') }}
                            </h2>
                            <p class="mb-1">
                                <strong>{{ __('admin.orders.show.status') }}:</strong>
                                <span class="badge {{ $statusConfig['class'] }}" style="{{ $statusConfig['style'] }}">
                                    {{ __('admin.orders.statuses.' . $status) }}
                                </span>
                            </p>
                            <p class="mb-1">
                                <strong>{{ __('admin.orders.show.placed_on', ['date' => $order->getOrderDate()->format('d/m/Y H:i')]) }}</strong>
                            </p>
                            <p class="fw-semibold mb-0">
                                {{ __('admin.orders.show.total') }}:
                                {{ number_format($order->getTotal(), 0, ',', '.') }} {{ __('admin.common.currency') }}
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="border rounded p-3 h-100">
                            <h2 class="h5 text-muted mb-3">
                                <i class="fas fa-map-marker-alt me-2"></i>{{ __('admin.orders.show.delivery') }}
                            </h2>
                            <p class="mb-2">{{ $order->getShippingAddress() }}</p>
                            @if($order->getNotes())
                                <h3 class="h6 text-muted mb-1">
                                    <i class="fas fa-sticky-note me-2"></i>{{ __('admin.orders.show.notes') }}
                                </h3>
                                <p class="mb-0">{{ $order->getNotes() }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <form action="{{ route('admin.order.updateStatus', $order->getId()) }}" method="POST" class="row g-3 align-items-end">
                    @csrf
                    @method('PUT')
                    <div class="col-md-4">
                        <label for="status" class="form-label">{{ __('admin.orders.show.status') }}</label>
                        <select name="status" id="status" class="form-select">
                            @foreach($viewData['statuses'] as $statusOption)
                                <option value="{{ $statusOption }}" @selected($statusOption === $status)>
                                    {{ __('admin.orders.statuses.' . $statusOption) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-sync-alt me-2"></i>{{ __('admin.orders.actions.update_status') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <h2 class="h4 text-primary mb-3">
                    <i class="fas fa-list me-2"></i>{{ __('admin.orders.show.items') }}
                </h2>
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">{{ __('admin.orders.show.product') }}</th>
                                <th scope="col" class="text-center">{{ __('admin.orders.show.quantity') }}</th>
                                <th scope="col" class="text-center">{{ __('admin.orders.show.unit_price') }}</th>
                                <th scope="col" class="text-end">{{ __('admin.orders.show.subtotal') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $total = 0; @endphp
                            @foreach($order->getOrderItems() as $orderItem)
                                @php
                                    $product = $orderItem->getProduct();
                                    $subtotal = $orderItem->calculateSubtotal();
                                    $total += $subtotal;
                                @endphp
                                <tr>
                                    <td class="fw-semibold">{{ $product ? $product->getName() : __('admin.orders.show.product_unavailable') }}</td>
                                    <td class="text-center">{{ $orderItem->getQuantity() }}</td>
                                    <td class="text-center">
                                        {{ number_format($orderItem->getUnitPrice(), 0, ',', '.') }} {{ __('admin.common.currency') }}
                                    </td>
                                    <td class="text-end">
                                        {{ number_format($subtotal, 0, ',', '.') }} {{ __('admin.common.currency') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="3" class="text-end">{{ __('admin.orders.show.total') }}</th>
                                <th class="text-end">
                                    {{ number_format($total, 0, ',', '.') }} {{ __('admin.common.currency') }}
                                </th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
