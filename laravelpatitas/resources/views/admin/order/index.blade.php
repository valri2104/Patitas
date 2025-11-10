@extends('layouts.admin')

@section('title', $title)
@section('subtitle', $subtitle)

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-3">
                            <h2 class="h4 fw-bold mb-3 mb-md-0">{{ __('admin.orders.index.filter_status') }}</h2>

                            <div class="d-flex flex-wrap gap-2">
                                {{-- Botón "Todos" --}}
                                <a href="{{ route('admin.order.index') }}"
                                    class="btn {{ empty($selectedStatus) ? 'btn-dark' : 'btn-outline-dark' }} btn-sm">
                                    {{ __('admin.orders.index.all_statuses') }}
                                </a>

                                @foreach ($statuses as $status)
                                    @switch($status)
                                        @case('pending')
                                            @php($class = 'btn-warning text-dark')
                                        @break

                                        @case('confirmed')
                                            @php($class = 'btn-primary')
                                        @break

                                        @case('shipped')
                                            @php($class = 'btn-secondary')
                                        @break

                                        @case('delivered')
                                            @php($class = 'btn-success')
                                        @break

                                        @case('cancelled')
                                            @php($class = 'btn-danger')
                                        @break

                                        @default
                                            @php($class = 'btn-outline-secondary')
                                    @endswitch

                                    <a href="{{ route('admin.order.index', ['status' => $status]) }}"
                                        class="btn {{ $selectedStatus === $status ? $class : 'btn-outline-secondary' }} btn-sm">
                                        {{ __('admin.orders.statuses.' . $status) }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm">
                    <div class="card-body p-0">
                        @if ($orders->isEmpty())
                            <div class="text-center py-5">
                                <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                                <p class="text-muted mb-0">{{ __('admin.orders.index.no_orders') }}</p>
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>{{ __('admin.orders.index.order_id') }}</th>
                                            <th>{{ __('admin.orders.index.customer') }}</th>
                                            <th>{{ __('admin.orders.index.date') }}</th>
                                            <th>{{ __('admin.orders.index.status') }}</th>
                                            <th>{{ __('admin.orders.index.total') }}</th>
                                            <th class="text-center">{{ __('admin.orders.index.actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                            @php($status = $order->getStatus())

                                            <tr>
                                                <td class="fw-semibold">#{{ $order->getId() }}</td>
                                                <td>{{ optional($order->getUser())->getName() ?? __('admin.orders.index.unknown_customer') }}
                                                </td>
                                                <td>{{ $order->getOrderDate()->format('d/m/Y H:i') }}</td>

                                                <td>
                                                    @switch($status)
                                                        @case('pending')
                                                            <span
                                                                class="badge bg-warning text-dark">{{ __('admin.orders.statuses.pending') }}</span>
                                                        @break

                                                        @case('confirmed')
                                                            <span
                                                                class="badge bg-primary">{{ __('admin.orders.statuses.confirmed') }}</span>
                                                        @break

                                                        @case('shipped')
                                                            <span class="badge text-white" style="background-color:#6f42c1;">
                                                                {{ __('admin.orders.statuses.shipped') }}
                                                            </span>
                                                        @break

                                                        @case('delivered')
                                                            <span
                                                                class="badge bg-success">{{ __('admin.orders.statuses.delivered') }}</span>
                                                        @break

                                                        @case('cancelled')
                                                            <span
                                                                class="badge bg-danger">{{ __('admin.orders.statuses.cancelled') }}</span>
                                                        @break

                                                        @default
                                                            <span
                                                                class="badge bg-secondary">{{ __('admin.orders.statuses.unknown') }}</span>
                                                    @endswitch
                                                </td>

                                                <td class="fw-bold">
                                                    {{ number_format($order->getTotal(), 0, ',', '.') }}
                                                    {{ __('admin.common.currency') }}
                                                </td>

                                                <td class="text-center">
                                                    <div
                                                        class="d-flex flex-column flex-lg-row justify-content-center align-items-stretch gap-2">

                                                        <a href="{{ route('admin.order.show', $order->getId()) }}"
                                                            class="btn btn-sm btn-outline-primary w-100">
                                                            <i class="fas fa-eye me-1"></i>
                                                            {{ __('admin.orders.actions.view') }}
                                                        </a>

                                                        <form
                                                            action="{{ route('admin.order.updateStatus', $order->getId()) }}"
                                                            method="POST"
                                                            class="d-flex gap-2 w-100 justify-content-center">
                                                            @csrf
                                                            @method('PUT')
                                                            <select name="status" class="form-select form-select-sm">
                                                                @foreach ($statuses as $statusOption)
                                                                    <option value="{{ $statusOption }}"
                                                                        @selected($statusOption === $status)>
                                                                        {{ __('admin.orders.statuses.' . $statusOption) }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            <button type="submit" class="btn btn-sm btn-secondary">
                                                                <i class="fas fa-sync-alt me-1"></i>
                                                                {{ __('admin.orders.actions.update_status') }}
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
