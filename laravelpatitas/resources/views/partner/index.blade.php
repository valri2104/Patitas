@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="row mb-3">
            <div class="col">
                <h1 class="mb-1">{{ $viewData['title'] }}</h1>
                <p class="text-muted mb-0">{{ $viewData['subtitle'] }}</p>
            </div>
        </div>

        <div class="alert alert-primary d-flex align-items-center justify-content-between" role="alert">
            <div>
                <i class="fas fa-handshake me-2"></i>{{ __('partners.banner.message') }}
            </div>
            <span class="badge bg-info text-dark text-uppercase">{{ __('partners.banner.badge') }}</span>
        </div>

        @if ($viewData['apiAvailable'] && ! empty($viewData['products']))
            <div class="row g-4">
                @foreach ($viewData['products'] as $product)
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="card h-100 shadow-sm">
                            <div class="position-absolute top-0 end-0 m-2">
                                <span class="badge bg-warning text-dark">{{ __('partners.fields.partner_badge') }}</span>
                            </div>
                            <img src="{{ $product['image'] ?? 'https://via.placeholder.com/400x250?text=Partner+Product' }}"
                                class="card-img-top"
                                alt="{{ $product['name'] }}">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $product['name'] }}</h5>
                                @if (! empty($product['id']))
                                    <p class="card-text text-muted small mb-2">
                                        {{ __('partners.fields.identifier', ['id' => $product['id']]) }}
                                    </p>
                                @endif
                                <p class="card-text text-muted">
                                    {{ $product['description'] ?? __('partners.fields.description_unavailable') }}
                                </p>
                                <p class="fw-bold mb-3">
                                    @if (! is_null($product['price']))
                                        {{ __('partners.fields.price', ['price' => number_format($product['price'], 0, ',', '.'), 'currency' => __('app.common.currency')]) }}
                                    @else
                                        {{ __('partners.fields.price_unavailable') }}
                                    @endif
                                </p>
                                <div class="mt-auto">
                                    <a class="btn btn-outline-primary w-100" target="_blank" rel="noopener"
                                        href="{{ ! empty($product['url']) ? $product['url'] : (! empty($product['id']) ? 'http://35.226.205.175/supplements/' . $product['id'] : '#') }}">
                                        <i class="fas fa-external-link-alt me-1"></i>{{ __('partners.actions.view_partner_site') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @elseif ($viewData['apiAvailable'])
            <div class="alert alert-info d-flex align-items-center" role="alert">
                <i class="fas fa-info-circle me-2"></i> {{ __('partners.messages.empty') }}
            </div>
        @else
            <div class="alert alert-warning d-flex flex-column flex-sm-row align-items-start align-items-sm-center justify-content-between"
                role="alert">
                <div class="d-flex align-items-center mb-3 mb-sm-0">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <span>{{ $viewData['errorMessage'] }}</span>
                </div>
                <a class="btn btn-secondary" href="{{ route('product.index') }}">
                    <i class="fas fa-paw me-1"></i>{{ __('partners.actions.back_to_catalog') }}
                </a>
            </div>
        @endif
    </div>
@endsection

