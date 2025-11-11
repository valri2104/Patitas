@extends('layouts.admin')

@section('title', $viewData['title'])
@section('subtitle', $viewData['subtitle'])

@section('content')
    <div class="container-fluid">
        <div class="alert alert-info d-flex align-items-center gap-2 mb-4" role="alert">
            <i class="fas fa-star-half-alt"></i>
            <span>{{ $viewData['info'] }}</span>
        </div>

        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <div class="d-flex flex-wrap gap-2 align-items-center mb-3">
                    <span class="fw-semibold">{{ __('admin.reviews.filters.rating') }}:</span>

                    <a href="{{ route('admin.review.index') }}"
                        class="btn btn-sm {{ $viewData['selectedRating'] === null ? 'btn-primary' : 'btn-outline-primary' }}">
                        {{ __('admin.reviews.filters.all_ratings') }}
                    </a>

                    @for ($i = 5; $i >= 1; $i--)
                        <a href="{{ route('admin.review.index', array_merge(request()->query(), ['rating' => $i])) }}"
                            class="btn btn-sm {{ $viewData['selectedRating'] === $i ? 'btn-primary' : 'btn-outline-primary' }}">
                            {{ __('admin.reviews.filters.stars', ['rating' => $i]) }}
                        </a>
                    @endfor
                </div>

                <form method="GET" action="{{ route('admin.review.index') }}" class="row g-3">
                    <input type="hidden" name="rating" value="{{ $viewData['filters']['rating'] ?? '' }}">
                    <div class="col-md-4">
                        <label for="product_id" class="form-label">{{ __('admin.reviews.filters.product') }}</label>
                        <select name="product_id" id="product_id" class="form-select">
                            <option value="">{{ __('admin.reviews.filters.all_products') }}</option>
                            @foreach ($viewData['products'] as $product)
                                <option value="{{ $product->getId() }}"
                                    {{ (int) ($viewData['filters']['productId'] ?? 0) === $product->getId() ? 'selected' : '' }}>
                                    {{ $product->getName() }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="user" class="form-label">{{ __('admin.reviews.filters.user') }}</label>
                        <input type="text" name="user" id="user" value="{{ $viewData['filters']['userSearch'] ?? '' }}"
                            class="form-control" placeholder="{{ __('admin.reviews.filters.placeholder') }}">
                    </div>
                    <div class="col-md-4 d-flex align-items-end gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search me-1"></i>{{ __('admin.reviews.filters.apply') }}
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
                                <th>{{ __('admin.reviews.table.author') }}</th>
                                <th>{{ __('admin.reviews.table.product') }}</th>
                                <th>{{ __('admin.reviews.table.rating') }}</th>
                                <th>{{ __('admin.reviews.table.description') }}</th>
                                <th>{{ __('admin.reviews.table.date') }}</th>
                                <th class="text-end">{{ __('admin.reviews.table.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($viewData['reviews'] as $review)
                                <tr>
                                    <td>
                                        <div class="fw-semibold">
                                            {{ $review->getUser()?->getName() ?? __('admin.orders.index.unknown_customer') }}
                                        </div>
                                        <small class="text-muted">
                                            {{ $review->getUser()?->getEmail() }}
                                        </small>
                                    </td>
                                    <td>
                                        {{ $review->getProduct()?->getName() ?? __('admin.orders.show.product_unavailable') }}
                                    </td>
                                    <td class="text-warning">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i
                                                class="{{ $i <= $review->getQualification() ? 'fas' : 'far' }} fa-star {{ $i <= $review->getQualification() ? '' : 'text-muted' }}"></i>
                                        @endfor
                                    </td>
                                    <td style="max-width: 320px;">
                                        <span class="text-muted">{{ $review->getShortDescription() }}</span>
                                    </td>
                                    <td>
                                        {{ $review->getFormattedCreatedAt() ?? __('admin.reviews.table.date') }}
                                    </td>
                                    <td class="text-end">
                                        <form action="{{ route('admin.review.destroy', $review->getId()) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                                onclick="return confirm('{{ __('admin.reviews.actions.confirm_delete') }}')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-muted">
                                        {{ __('admin.reviews.index.empty') }}
                                    </td>
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
