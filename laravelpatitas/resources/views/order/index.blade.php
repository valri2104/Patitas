@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="h2 fw-bold text-primary mb-1">{{ __('orders.index.title') }}</h1>
                    <p class="text-muted mb-0">{{ __('orders.index.subtitle') }}</p>
                </div>
            </div>

            @if($viewData['orders']->isEmpty())
                <div class="card shadow-sm">
                    <div class="card-body text-center py-5">
                        <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                        <p class="text-muted mb-0">{{ __('orders.index.empty') }}</p>
                    </div>
                </div>
            @else
                <div class="card shadow-sm">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">{{ __('orders.index.order_id') }}</th>
                                        <th scope="col">{{ __('orders.index.date') }}</th>
                                        <th scope="col">{{ __('orders.index.status') }}</th>
                                        <th scope="col">{{ __('orders.index.total') }}</th>
                                        <th scope="col" class="text-end">{{ __('orders.index.actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($viewData['orders'] as $order)
                                        @php
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
                                        <tr>
                                            <td class="fw-semibold">#{{ $order->getId() }}</td>
                                            <td>{{ $formattedDate }}</td>
                                            <td>
                                                <span class="badge {{ $statusConfig['class'] }}" style="{{ $statusConfig['style'] }}">
                                                    {{ __('orders.status.' . $status) }}
                                                </span>
                                            </td>
                                            <td class="fw-bold">
                                                {{ number_format($order->getTotal(), 0, ',', '.') }} {{ __('app.common.currency') }}
                                            </td>
                                            <td class="text-end">
                                                <a href="{{ route('order.show', $order->getId()) }}" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-eye me-1"></i>{{ __('orders.index.view') }}
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
