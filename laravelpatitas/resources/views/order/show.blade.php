@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <a href="{{ route('order.index') }}" class="btn btn-outline-secondary mb-3">
                <i class="fas fa-arrow-left me-2"></i>{{ __('orders.show.back') }}
            </a>

            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    @php
                        $order = $viewData['order'];
                        $status = $order->getStatus();
                        $statusConfigs = [
                            'pending' => ['class' => 'bg-warning text-dark', 'style' => ''],
                            'confirmed' => ['class' => 'bg-primary', 'style' => ''],
                            'shipped' => ['class' => 'text-white', 'style' => 'background-color: #6f42c1;'],
                            'delivered' => ['class' => 'bg-success', 'style' => ''],
                            'cancelled' => ['class' => 'bg-danger', 'style' => ''],
                        ];
                        $statusConfig = $statusConfigs[$status] ?? ['class' => 'bg-secondary', 'style' => ''];
                        $formattedDate = \Carbon\Carbon::parse($order->getCreatedAt())->format('d/m/Y H:i');
                    @endphp
                    <div class="d-flex justify-content-between flex-column flex-md-row align-items-md-center mb-3">
                        <div>
                            <h1 class="h3 fw-bold text-primary mb-1">{{ __('orders.show.title', ['id' => $order->getId()]) }}</h1>
                            <p class="text-muted mb-0">
                                <i class="fas fa-calendar-alt me-2"></i>{{ __('orders.show.placed_on', ['date' => $formattedDate]) }}
                            </p>
                        </div>
                        <div class="mt-3 mt-md-0">
                            <span class="badge {{ $statusConfig['class'] }}" style="{{ $statusConfig['style'] }}">
                                {{ __('orders.status.' . $status) }}
                            </span>
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="border rounded p-3 h-100">
                                <h2 class="h5 text-muted mb-3">
                                    <i class="fas fa-map-marker-alt me-2"></i>{{ __('orders.show.delivery_address') }}
                                </h2>
                                <p class="mb-0 fw-semibold">{{ $order->getShippingAddress() }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="border rounded p-3 h-100">
                                <h2 class="h5 text-muted mb-3">
                                    <i class="fas fa-info-circle me-2"></i>{{ __('orders.show.status') }}
                                </h2>
                                <p class="mb-2">{{ __('orders.status.' . $status) }}</p>
                                <p class="mb-0 fw-semibold text-success">
                                    {{ __('orders.show.total') }}:
                                    {{ number_format($order->getTotal(), 0, ',', '.') }} {{ __('app.common.currency') }}
                                </p>
                            </div>
                        </div>
                    </div>

                    @if(!empty($order->getNotes()))
                        <div class="border rounded p-3 mt-3">
                            <h2 class="h5 text-muted mb-2">
                                <i class="fas fa-sticky-note me-2"></i>{{ __('orders.show.notes') }}
                            </h2>
                            <p class="mb-0">{{ $order->getNotes() }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-body">
                    <h2 class="h4 text-primary mb-3">
                        <i class="fas fa-list me-2"></i>{{ __('orders.show.items') }}
                    </h2>
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">{{ __('orders.show.product') }}</th>
                                    <th scope="col" class="text-center">{{ __('orders.show.quantity') }}</th>
                                    <th scope="col" class="text-center">{{ __('orders.show.unit_price') }}</th>
                                    <th scope="col" class="text-end">{{ __('orders.show.subtotal') }}</th>
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
                                        <td>
                                            <strong>{{ $product?->getName() }}</strong>
                                        </td>
                                        <td class="text-center">{{ $orderItem->getQuantity() }}</td>
                                        <td class="text-center">
                                            {{ number_format($orderItem->getUnitPrice(), 0, ',', '.') }} {{ __('app.common.currency') }}
                                        </td>
                                        <td class="text-end">
                                            {{ number_format($subtotal, 0, ',', '.') }} {{ __('app.common.currency') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="3" class="text-end">{{ __('orders.show.total') }}</th>
                                    <th class="text-end">
                                        {{ number_format($total, 0, ',', '.') }} {{ __('app.common.currency') }}
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
