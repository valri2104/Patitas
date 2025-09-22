@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
    <div class="container my-4">
        <div class="row">
            <!-- Breadcrumb -->
            <div class="col-12 mb-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('messages.home') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('product.index') }}">{{ __('messages.products') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $viewData['product']->getName() }}</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            <!-- Product Image -->
            <div class="col-md-6 mb-4">
                @if($viewData['product']->getImageUrl())
                    <img src="{{ $viewData['product']->getImageUrl() }}" class="img-fluid rounded" alt="{{ $viewData['product']->getName() }}">
                @else
                    <div class="bg-light rounded d-flex align-items-center justify-content-center" style="height: 400px;">
                        <i class="fas fa-image text-muted fa-5x"></i>
                    </div>
                @endif
            </div>

            <!-- Product Details -->
            <div class="col-md-6">
                <h1 class="fw-bold mb-3">{{ $viewData['product']->getName() }}</h1>
                
                <div class="mb-3">
                    <span class="badge bg-secondary fs-6">{{ $viewData['product']->getCategory() }}</span>
                </div>

                <div class="mb-4">
                    <span class="h3 text-primary">${{ number_format($viewData['product']->getPrice(), 2) }}</span>
                </div>

                <!-- Stock Status -->
                <div class="mb-4">
                    @if($viewData['product']->getStock() > 0)
                        <div class="alert alert-success" role="alert">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ __('messages.in_stock') }} - {{ $viewData['product']->getStock() }} {{ __('messages.units_available') }}
                        </div>
                    @else
                        <div class="alert alert-danger" role="alert">
                            <i class="fas fa-times-circle me-2"></i>
                            {{ __('messages.out_of_stock') }}
                        </div>
                    @endif
                </div>

                <!-- Product Description -->
                <div class="mb-4">
                    <h4>{{ __('messages.description') }}</h4>
                    <p class="text-muted">{{ $viewData['product']->getDescription() }}</p>
                </div>

                <!-- Action Buttons -->
                <div class="d-grid gap-2 d-md-flex">
                    @if($viewData['product']->getStock() > 0)
                        <button class="btn btn-primary btn-lg me-md-2" type="button">
                            <i class="fas fa-shopping-cart me-2"></i>
                            {{ __('messages.add_to_cart') }}
                        </button>
                    @endif
                    
                    <a href="{{ route('product.index') }}" class="btn btn-outline-secondary btn-lg">
                        <i class="fas fa-arrow-left me-2"></i>
                        {{ __('messages.back_to_products') }}
                    </a>
                </div>

                <!-- Product Meta Information -->
                <div class="mt-4 pt-4 border-top">
                    <h5>{{ __('messages.product_information') }}</h5>
                    <ul class="list-unstyled">
                        <li><strong>{{ __('messages.category') }}:</strong> {{ $viewData['product']->getCategory() }}</li>
                        <li><strong>{{ __('messages.stock') }}:</strong> {{ $viewData['product']->getStock() }} {{ __('messages.units') }}</li>
                        <li><strong>{{ __('messages.created_at') }}:</strong> {{ $viewData['product']->getCreatedAt() }}</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Related Products Section (if you want to implement later) -->
        <div class="row mt-5">
            <div class="col-12">
                <h3>{{ __('messages.related_products') }}</h3>
                <hr>
                <p class="text-muted">{{ __('messages.related_products_coming_soon') }}</p>
            </div>
        </div>
    </div>
@endsection