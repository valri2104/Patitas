@extends('layouts.admin')

@section('title', __('admin.reviews.index.title'))
@section('subtitle', __('admin.reviews.index.subtitle'))

@section('content')
    <div class="container-fluid">
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <form method="GET" action="{{ route('admin.review.index') }}" class="row g-3">
                    <div class="col-md-3">
                        <label for="rating" class="form-label">{{ __('admin.reviews.filters.rating') }}</label>
                        <select name="rating" id="rating" class="form-select">
                            <option value="">{{ __('admin.reviews.filters.all_ratings') }}</option>
                            @for ($i = 5; $i >= 1; $i--)
                                <option value="{{ $i }}" {{ (int) ($viewData['filters']['rating'] ?? 0) === $i ? 'selected' : '' }}>{{ $i }} ★</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="product_id" class="form-label">{{ __('admin.reviews.filters.product') }}</label>
                        <select name="product_id" id="product_id" class="form-select">
                            <option value="">{{ __('admin.reviews.filters.all_products') }}</option>
                            @foreach ($viewData['products'] as $product)
                                <option value="{{ $product->getId() }}" {{ (int)($viewData['filters']['product_id'] ?? 0) === $product->getId() ? 'selected' : '' }}>
                                    {{ $product->getName() }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="user" class="form-label">{{ __('admin.reviews.filters.user') }}</label>
                        <input type="text" name="user" id="user" value="{{ $viewData['filters']['user'] ?? '' }}" class="form-control" placeholder="{{ __('admin.reviews.filters.placeholder') }}">
                    </div>
                    <div class="col-md-2 d-flex align-items-end gap-2">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-filter me-1"></i>{{ __('admin.reviews.filters.apply') }}
                        </button>
                        <a href="{{ route('admin.review.index') }}" class="btn btn-outline-secondary">
                            {{ __('admin.reviews.filters.clear') }}
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">{{ __('admin.reviews.table.author') }}</th>
                                <th scope="col">{{ __('admin.reviews.table.product') }}</th>
                                <th scope="col">{{ __('admin.reviews.table.rating') }}</th>
                                <th scope="col">{{ __('admin.reviews.table.description') }}</th>
                                <th scope="col">{{ __('admin.reviews.table.date') }}</th>
                                <th scope="col" class="text-end">{{ __('admin.reviews.table.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($viewData['reviews'] as $review)
                                <tr>
                                    <td>
                                        <div class="fw-semibold">{{ $review->getUser()?->getName() ?? __('admin.orders.index.unknown_customer') }}</div>
                                        <small class="text-muted">{{ $review->getUser()?->getEmail() }}</small>
                                    </td>
                                    <td>
                                        <div class="fw-semibold">{{ $review->getProduct()?->getName() ?? __('admin.orders.show.product_unavailable') }}</div>
                                    </td>
                                    <td class="text-warning">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $review->getQualification())
                                                <i class="fas fa-star"></i>
                                            @else
                                                <i class="far fa-star text-muted"></i>
                                            @endif
                                        @endfor
                                    </td>
                                    <td style="max-width: 320px;">
                                        <span class="text-muted">{{ $review->getDescription() }}</span>
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($review->getCreatedAt())->format('d/m/Y H:i') }}</td>
                                    <td class="text-end">
                                        <form action="{{ route('admin.review.destroy', $review->getId()) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('{{ __('admin.products.actions.confirm_delete') }}')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-muted">{{ __('admin.reviews.index.subtitle') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if (method_exists($viewData['reviews'], 'links'))
                <div class="card-footer">
                    {{ $viewData['reviews']->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
