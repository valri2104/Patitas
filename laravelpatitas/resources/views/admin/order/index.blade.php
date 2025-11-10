@extends('layouts.admin')

@section('title', __('admin.orders.index.title'))
@section('subtitle', __('admin.orders.index.subtitle'))

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-3">
                            <h2 class="h4 fw-bold mb-3 mb-md-0">{{ __('admin.orders.index.filter_status') }}</h2>
                            <div class="d-flex flex-wrap gap-2">
                                @php
                                    $statusConfigs = [
                                        'pending' => 'btn-warning text-dark',
                                        'confirmed' => 'btn-primary',
                                        'shipped' => 'btn-secondary',
                                        'delivered' => 'btn-success',
                                        'cancelled' => 'btn-danger',
                                    ];
                                @endphp
                                <a href="{{ route('admin.order.index') }}"
                                   class="btn {{ empty($viewData['selectedStatus']) ? 'btn-dark' : 'btn-outline-dark' }} btn-sm">
                                    {{ __('admin.orders.index.all_statuses') }}
                                </a>
                                @foreach($viewData['statuses'] as $status)
                                    @php
                                        $buttonClass = $statusConfigs[$status] ?? 'btn-outline-secondary';
                                        $isSelected = $viewData['selectedStatus'] === $status;
                                        $class = $isSelected ? $buttonClass : 'btn-outline-secondary';
                                    @endphp
                                    <a href="{{ route('admin.order.index', ['status' => $status]) }}"
                                       class="btn {{ $class }} btn-sm">
                                        {{ __('admin.orders.statuses.' . $status) }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm">
                    <div class="card-body p-0">
                        @if($viewData['orders']->isEmpty())
                            <div class="text-center py-5">
                                <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                                <p class="text-muted mb-0">{{ __('admin.orders.index.no_orders') }}</p>
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead class="table-dark">
                                        <tr>
                                            <th scope="col">{{ __('admin.orders.index.order_id') }}</th>
                                            <th scope="col">{{ __('admin.orders.index.customer') }}</th>
                                            <th scope="col">{{ __('admin.orders.index.date') }}</th>
                                            <th scope="col">{{ __('admin.orders.index.status') }}</th>
                                            <th scope="col">{{ __('admin.orders.index.total') }}</th>
                                            <th scope="col" class="text-center">{{ __('admin.orders.index.actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($viewData['orders'] as $order)
                                            @php
                                                $status = $order->getStatus();
                                                $badgeConfigs = [
                                                    'pending' => ['class' => 'bg-warning text-dark', 'style' => ''],
                                                    'confirmed' => ['class' => 'bg-primary', 'style' => ''],
                                                    'shipped' => ['class' => 'text-white', 'style' => 'background-color: #6f42c1;'],
                                                    'delivered' => ['class' => 'bg-success', 'style' => ''],
                                                    'cancelled' => ['class' => 'bg-danger', 'style' => ''],
                                                ];
                                                $badgeConfig = $badgeConfigs[$status] ?? ['class' => 'bg-secondary', 'style' => ''];
                                                $customer = $order->getUser();
                                                $customerName = $customer ? $customer->getName() : __('admin.orders.index.unknown_customer');
                                                $formattedDate = $order->getOrderDate()->format('d/m/Y H:i');
                                            @endphp
                                            <tr>
                                                <td class="fw-semibold">#{{ $order->getId() }}</td>
                                                <td>{{ $customerName }}</td>
                                                <td>{{ $formattedDate }}</td>
                                                <td>
                                                    <span class="badge {{ $badgeConfig['class'] }}" style="{{ $badgeConfig['style'] }}">
                                                        {{ __('admin.orders.statuses.' . $status) }}
                                                    </span>
                                                </td>
                                                <td class="fw-bold">
                                                    {{ number_format($order->getTotal(), 0, ',', '.') }} {{ __('admin.common.currency') }}
                                                </td>
                                                <td class="text-center">
                                                    <div class="d-flex flex-column flex-lg-row justify-content-center align-items-stretch gap-2">
                                                        <a href="{{ route('admin.order.show', $order->getId()) }}"
                                                           class="btn btn-sm btn-outline-primary w-100">
                                                            <i class="fas fa-eye me-1"></i>{{ __('admin.orders.actions.view') }}
                                                        </a>
                                                        <form action="{{ route('admin.order.updateStatus', $order->getId()) }}" method="POST"
                                                              class="d-flex gap-2 w-100 justify-content-center">
                                                            @csrf
                                                            @method('PUT')
                                                            <select name="status" class="form-select form-select-sm">
                                                                @foreach($viewData['statuses'] as $statusOption)
                                                                    <option value="{{ $statusOption }}" @selected($statusOption === $status)>
                                                                        {{ __('admin.orders.statuses.' . $statusOption) }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            <button type="submit" class="btn btn-sm btn-secondary">
                                                                <i class="fas fa-sync-alt me-1"></i>{{ __('admin.orders.actions.update_status') }}
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
