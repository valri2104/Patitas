@extends('layouts.admin')

@section('title', __('admin.products.index.title'))
@section('subtitle', __('admin.products.index.subtitle'))

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- Header with Create Button -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h2>{{ __('admin.products.index.title') }}</h2>
                        <p class="text-muted mb-0">{{ __('admin.products.index.subtitle') }}</p>
                    </div>
                    <a href="{{ route('admin.product.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>{{ __('admin.products.index.create_new') }}
                    </a>
                </div>

                <!-- Products Table -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            {{ __('admin.products.index.total_products', ['count' => count($viewData['products'])]) }}</h5>
                    </div>
                    <div class="card-body p-0">
                        @if (count($viewData['products']) > 0)
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead class="table-dark">
                                        <tr>
                                            <th scope="col">{{ __('admin.products.table.name') }}</th>
                                            <th scope="col">{{ __('admin.products.table.category') }}</th>
                                            <th scope="col">{{ __('admin.products.table.price') }}</th>
                                            <th scope="col">{{ __('admin.products.table.stock') }}</th>
                                            <th scope="col">{{ __('admin.products.table.status') }}</th>
                                            <th scope="col" class="text-center">{{ __('admin.products.table.actions') }}
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($viewData['products'] as $product)
                                            <tr>
                                                <td>
                                                    <div class="fw-bold">{{ $product->getName() }}</div>
                                                </td>
                                                <td>
                                                    <span class="badge bg-secondary">
                                                        {{ __('admin.products.categories.' . $product->getCategory()) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="fw-bold text-success">
                                                        {{ number_format($product->getPrice(), 0, ',', '.') }}
                                                        {{ __('admin.common.currency') }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span
                                                        class="badge {{ $product->getStock() > 10 ? 'bg-success' : ($product->getStock() > 0 ? 'bg-warning' : 'bg-danger') }}">
                                                        {{ $product->getStock() }}
                                                    </span>
                                                </td>
                                                <td>
                                                    @if ($product->isInStock())
                                                        <span class="badge bg-success">
                                                            {{ __('admin.products.table.in_stock') }}
                                                        </span>
                                                    @else
                                                        <span class="badge bg-danger">
                                                            {{ __('admin.products.table.out_of_stock') }}
                                                        </span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <div class="btn-group" role="group">
                                                        <!-- View Button -->
                                                        <a href="{{ route('admin.product.show', $product->getId()) }}"
                                                            class="btn btn-primary"
                                                            title="{{ __('admin.products.actions.view') }}">
                                                            <i class="fas fa-eye"></i>
                                                        </a>

                                                        <!-- Edit Button -->
                                                        <a href="{{ route('admin.product.edit', $product->getId()) }}"
                                                            class="btn btn-info"
                                                            title="{{ __('admin.products.actions.edit') }}">
                                                            <i class="fas fa-edit"></i>
                                                        </a>

                                                        <form
                                                            action="{{ route('admin.product.destroy', $product->getId()) }}"
                                                            method="POST" class="d-inline delete-form">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger"
                                                                title="{{ __('admin.products.actions.delete') }}"
                                                                onclick="return confirm('¿Estás seguro de que deseas eliminar este producto?')">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-5">
                                <div class="mb-3">
                                    <i class="fas fa-box-open fa-3x text-muted"></i>
                                </div>
                                <h5 class="text-muted">{{ __('admin.products.index.no_products') }}</h5>
                                <p class="text-muted mb-3">{{ __('admin.products.index.subtitle') }}</p>
                                <a href="{{ route('admin.product.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus me-2"></i>{{ __('admin.products.index.create_new') }}
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
