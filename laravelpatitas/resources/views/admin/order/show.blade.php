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
                <div class="row g-4">
                    <div class="col-lg-4">
                        <div class="border rounded p-3 h-100">
                            <h2 class="h5 text-muted mb-3">
                                <i class="fas fa-user me-2"></i>{{ __('admin.orders.show.customer') }}
                            </h2>
                            <p class="fw-bold mb-1">
                                {{ optional($viewData['order']->getUser())->getName() ?? __('admin.orders.index.unknown_customer') }}
                            </p>
                            <p class="text-muted mb-0">
                                {{ optional($viewData['order']->getUser())->getEmail() ?? __('admin.orders.show.email_unavailable') }}
                            </p>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="border rounded p-3 h-100">
                            <h2 class="h5 text-muted mb-3">
                                <i class="fas fa-info-circle me-2"></i>{{ __('admin.orders.show.order_details') }}
                            </h2>

                            <p class="mb-1">
                                <strong>{{ __('admin.orders.show.status') }}:</strong>
                                @switch($viewData['status'])
                                    @case('pending')
                                        <span class="badge bg-warning text-dark">{{ __('admin.orders.statuses.pending') }}</span>
                                    @break

                                    @case('confirmed')
                                        <span class="badge bg-primary">{{ __('admin.orders.statuses.confirmed') }}</span>
                                    @break

                                    @case('shipped')
                                        <span class="badge text-white" style="background-color:#6f42c1;">
                                            {{ __('admin.orders.statuses.shipped') }}
                                        </span>
                                    @break

                                    @case('delivered')
                                        <span class="badge bg-success">{{ __('admin.orders.statuses.delivered') }}</span>
                                    @break

                                    @case('cancelled')
                                        <span class="badge bg-danger">{{ __('admin.orders.statuses.cancelled') }}</span>
                                    @break

                                    @default
                                        <span class="badge bg-secondary">{{ __('admin.orders.statuses.unknown') }}</span>
                                @endswitch
                            </p>

                            <p class="mb-1">
                                <strong>
                                    {{ __('admin.orders.show.placed_on', ['date' => $viewData['order']->getOrderDate()->format('d/m/Y H:i')]) }}
                                </strong>
                            </p>
                            <p class="fw-semibold mb-0">
                                {{ __('admin.orders.show.total') }}:
                                {{ number_format($viewData['order']->getTotal(), 0, ',', '.') }}
                                {{ __('admin.common.currency') }}
                            </p>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="border rounded p-3 h-100">
                            <h2 class="h5 text-muted mb-3">
                                <i class="fas fa-map-marker-alt me-2"></i>{{ __('admin.orders.show.delivery') }}
                            </h2>
                            <p class="mb-2">{{ $viewData['order']->getShippingAddress() }}</p>
                            @if ($viewData['order']->getNotes())
                                <h3 class="h6 text-muted mb-1">
                                    <i class="fas fa-sticky-note me-2"></i>{{ __('admin.orders.show.notes') }}
                                </h3>
                                <p class="mb-0">{{ $viewData['order']->getNotes() }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <form action="{{ route('admin.order.updateStatus', $viewData['order']->getId()) }}" method="POST"
                    class="row g-3 align-items-end">
                    @csrf
                    @method('PUT')
                    <div class="col-md-4">
                        <label for="status" class="form-label">{{ __('admin.orders.show.status') }}</label>
                        <select name="status" id="status" class="form-select">
                            @foreach ($viewData['statuses'] as $statusOption)
                                <option value="{{ $statusOption }}" @selected($statusOption === $viewData['status'])>
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
                                <th>{{ __('admin.orders.show.product') }}</th>
                                <th class="text-center">{{ __('admin.orders.show.quantity') }}</th>
                                <th class="text-center">{{ __('admin.orders.show.unit_price') }}</th>
                                <th class="text-end">{{ __('admin.orders.show.subtotal') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($viewData['order']->getOrderItems() as $orderItem)
                                <tr>
                                    <td>{{ optional($orderItem->getProduct())->getName() ?? __('admin.orders.show.product_unavailable') }}
                                    </td>
                                    <td class="text-center">{{ $orderItem->getQuantity() }}</td>
                                    <td class="text-center">
                                        {{ number_format($orderItem->getUnitPrice(), 0, ',', '.') }}
                                        {{ __('admin.common.currency') }}
                                    </td>
                                    <td class="text-end">
                                        {{ number_format($orderItem->calculateSubtotal(), 0, ',', '.') }}
                                        {{ __('admin.common.currency') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="3" class="text-end">{{ __('admin.orders.show.total') }}</th>
                                <th class="text-end">
                                    {{ number_format($viewData['total'], 0, ',', '.') }} {{ __('admin.common.currency') }}
                                </th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
