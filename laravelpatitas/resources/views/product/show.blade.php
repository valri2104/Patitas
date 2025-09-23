@extends('layouts.app')

@section('title', $viewData['product']->getName())

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <!-- Breadcrumb Navigation -->
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home.index') }}">{{ __('app.navigation.home') }}</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('product.index') }}">{{ __('app.navigation.products') }}</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ $viewData['product']->getName() }}
                    </li>
                </ol>
            </nav>

            <!-- Product Details Card -->
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="row">
                        <!-- Product Image -->
                        <div class="col-lg-5 col-md-6 mb-4">
                            <div class="text-center">
                                <img src="{{ $viewData['product']->getImageUrl() ?: 'https://via.placeholder.com/500x500/cccccc/666666?text=Sin+Imagen' }}" 
                                     alt="{{ $viewData['product']->getName() }}" 
                                     class="img-fluid rounded border shadow-sm product-detail-image">
                                
                                <!-- Category Badge -->
                                <div class="mt-3">
                                    <span class="badge bg-primary fs-6 px-3 py-2">
                                        {{ __('app.products.categories.' . $viewData['product']->getCategory()) }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Product Information -->
                        <div class="col-lg-7 col-md-6">
                            <!-- Product Title -->
                            <h1 class="display-5 fw-bold text-primary mb-3">
                                {{ $viewData['product']->getName() }}
                            </h1>

                            <!-- Price -->
                            <div class="mb-4">
                                <span class="display-6 fw-bold text-success">
                                    {{ number_format($viewData['product']->getPrice(), 0, ',', '.') }} {{ __('app.common.currency') }}
                                </span>
                            </div>

                            <!-- Product Details -->
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <!-- Stock Status -->
                                    <div class="mb-3">
                                        <h6 class="text-muted mb-2">{{ __('app.products.show.stock') }}</h6>
                                        @if($viewData['product']->isInStock())
                                            <span class="badge bg-success fs-6 px-3 py-2">
                                                <i class="fas fa-check-circle me-1"></i>
                                                {{ __('app.products.show.in_stock') }}
                                            </span>
                                            <div class="text-muted small mt-1">
                                                {{ trans_choice('app.products.show.units_available', $viewData['product']->getStock(), ['count' => $viewData['product']->getStock()]) }}
                                            </div>
                                        @else
                                            <span class="badge bg-danger fs-6 px-3 py-2">
                                                <i class="fas fa-times-circle me-1"></i>
                                                {{ __('app.products.show.out_of_stock') }}
                                            </span>
                                        @endif
                                    </div>

                                    <!-- Category -->
                                    <div class="mb-3">
                                        <h6 class="text-muted mb-2">{{ __('app.products.show.category') }}</h6>
                                        <span class="badge bg-secondary fs-6 px-3 py-2">
                                            {{ __('app.products.categories.' . $viewData['product']->getCategory()) }}
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <!-- Customizable -->
                                    <div class="mb-3">
                                        <h6 class="text-muted mb-2">{{ __('app.products.show.customizable') }}</h6>
                                        <span class="badge {{ $viewData['product']->getCustomizable() ? 'bg-info' : 'bg-secondary' }} fs-6 px-3 py-2">
                                            {{ $viewData['product']->getCustomizable() ? __('app.common.yes') : __('app.common.no') }}
                                        </span>
                                    </div>

                                    <!-- Price Display -->
                                    <div class="mb-3">
                                        <h6 class="text-muted mb-2">{{ __('app.products.show.price') }}</h6>
                                        <div class="h5 text-success fw-bold">
                                            {{ number_format($viewData['product']->getPrice(), 0, ',', '.') }} {{ __('app.common.currency') }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="d-grid gap-2 d-md-flex justify-content-md-start mb-4">
                                @if($viewData['product']->isInStock())
                                    <form method="POST" action="{{ route('cart.add') }}">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $viewData['product']->getId() }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="btn btn-success btn-lg flex-md-fill me-md-2">
                                            <i class="fas fa-shopping-cart me-2"></i>
                                            {{ __('app.products.actions.add_to_cart') }}
                                        </button>
                                    </form>
                                @else
                                    <button class="btn btn-secondary btn-lg flex-md-fill me-md-2" disabled>
                                        <i class="fas fa-ban me-2"></i>
                                        {{ __('app.products.show.out_of_stock') }}
                                    </button>
                                @endif
                                
                                <a href="{{ route('product.index') }}" class="btn btn-outline-primary btn-lg flex-md-fill">
                                    <i class="fas fa-arrow-left me-2"></i>
                                    {{ __('app.products.show.back_to_catalog') }}
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Product Description -->
                    @if($viewData['product']->getDescription())
                        <div class="row mt-5">
                            <div class="col-12">
                                <div class="border-top pt-4">
                                    <h3 class="h4 text-primary mb-3">
                                        <i class="fas fa-info-circle me-2"></i>
                                        {{ __('app.products.show.description') }}
                                    </h3>
                                    <div class="lead text-muted">
                                        {{ $viewData['product']->getDescription() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Additional Product Information -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="border-top pt-4">
                                <h4 class="text-primary mb-3">
                                    <i class="fas fa-clipboard-list me-2"></i>
                                    {{ __('app.products.show.additional_info') }}
                                </h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card bg-light">
                                            <div class="card-body">
                                                <h6 class="card-title text-muted">{{ __('app.products.show.product_details') }}</h6>
                                                <ul class="list-unstyled mb-0">
                                                    <li><strong>{{ __('app.products.show.category') }}:</strong> {{ __('app.products.categories.' . $viewData['product']->getCategory()) }}</li>
                                                    <li><strong>{{ __('app.products.show.stock') }}:</strong> {{ $viewData['product']->getStock() }} {{ __('app.products.show.units') }}</li>
                                                    <li><strong>{{ __('app.products.show.customizable') }}:</strong> {{ $viewData['product']->getCustomizable() ? __('app.common.yes') : __('app.common.no') }}</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card bg-light">
                                            <div class="card-body">
                                                <h6 class="card-title text-muted">{{ __('app.products.show.purchase_info') }}</h6>
                                                <ul class="list-unstyled mb-0">
                                                    <li><strong>{{ __('app.products.show.price') }}:</strong> {{ number_format($viewData['product']->getPrice(), 0, ',', '.') }} {{ __('app.common.currency') }}</li>
                                                    <li><strong>{{ __('app.products.show.availability') }}:</strong> 
                                                        @if($viewData['product']->isInStock())
                                                            <span class="text-success">{{ __('app.products.show.in_stock') }}</span>
                                                        @else
                                                            <span class="text-danger">{{ __('app.products.show.out_of_stock') }}</span>
                                                        @endif
                                                    </li>
                                                    <li><strong>{{ __('app.products.show.shipping') }}:</strong> {{ __('app.products.show.free_shipping') }}</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
