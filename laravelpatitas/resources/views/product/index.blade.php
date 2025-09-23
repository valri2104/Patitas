@extends('layouts.app')

@section('title', __('app.products.list.title'))

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <!-- Header Section -->
            <div class="text-center mb-5">
                <h1 class="display-4 text-primary">{{ __('app.products.list.title') }}</h1>
                <p class="lead text-muted">{{ __('app.products.list.subtitle') }}</p>
            </div>

            <!-- Search and Category Filter Section -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <form method="GET" action="{{ route('product.index') }}" class="row g-2 align-items-center mb-3">
                                <div class="col-md-8">
                                    <label for="search" class="visually-hidden">{{ __('app.common.search') }}</label>
                                    <input type="text" id="search" name="q" value="{{ $viewData['searchTerm'] ?? '' }}" class="form-control" placeholder="{{ __('app.common.search') }}" />
                                </div>
                                <div class="col-md-4 d-grid d-md-flex justify-content-md-end">
                                    <button type="submit" class="btn btn-primary me-md-2">
                                        <i class="fas fa-search me-2"></i>{{ __('app.common.search') }}
                                    </button>
                                    <a href="{{ route('product.index') }}" class="btn btn-outline-secondary">
                                        <i class="fas fa-times me-2"></i>{{ __('app.common.clear_filters') }}
                                    </a>
                                </div>
                            </form>

                            <h5 class="card-title mb-3">{{ __('app.products.list.filter_by_category') }}</h5>
                            <div class="d-flex flex-wrap gap-2">
                                <!-- All Categories Link -->
                                <a href="{{ route('product.index') }}" 
                                   class="btn {{ empty($viewData['selectedCategory']) ? 'btn-primary' : 'btn-outline-primary' }}">
                                    {{ __('app.products.list.all_categories') }}
                                </a>
                                
                                <!-- Category Filter Links -->
                                @foreach($viewData['categories'] as $category)
                                    <a href="{{ route('product.index', ['category' => $category] + (isset($viewData['searchTerm']) && $viewData['searchTerm'] !== '' ? ['q' => $viewData['searchTerm']] : [])) }}" 
                                       class="btn {{ $viewData['selectedCategory'] === $category ? 'btn-primary' : 'btn-outline-primary' }}">
                                        {{ __('app.products.categories.' . $category) }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Selected Category Info -->
            @if(!empty($viewData['selectedCategory']))
                <div class="row mb-3">
                    <div class="col-12">
                        <div class="alert alert-info">
                            <i class="fas fa-filter me-2"></i>
                            {{ __('app.products.list.showing_category', ['category' => __('app.products.categories.' . $viewData['selectedCategory'])]) }}
                        </div>
                    </div>
                </div>
            @endif

            <!-- Products Count -->
            <div class="row mb-3">
                <div class="col-12">
                    <p class="text-muted">
                        {{ trans_choice('app.products.list.products_found', count($viewData['products']), ['count' => count($viewData['products'])]) }}
                    </p>
                </div>
            </div>

            <!-- Products Grid -->
            @if(count($viewData['products']) > 0)
                <div class="row">
                    @foreach($viewData['products'] as $product)
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                            <div class="card h-100 shadow-sm product-card">
                                <!-- Product Image -->
                                <div class="card-img-top-container position-relative">
                                    <img src="{{ $product->getImageUrl() }}" 
                                         class="card-img-top" 
                                         alt="{{ $product->getName() }}"
                                         style="height: 200px; object-fit: cover;">
                                    
                                    <!-- Category Badge -->
                                    <span class="badge bg-secondary position-absolute top-0 start-0 m-2">
                                        {{ __('app.products.categories.' . $product->getCategory()) }}
                                    </span>
                                    
                                    <!-- Stock Status Badge -->
                                    @if($product->isInStock())
                                        <span class="badge bg-success position-absolute top-0 end-0 m-2">
                                            {{ __('app.products.show.in_stock') }}
                                        </span>
                                    @else
                                        <span class="badge bg-danger position-absolute top-0 end-0 m-2">
                                            {{ __('app.products.show.out_of_stock') }}
                                        </span>
                                    @endif
                                </div>

                                <!-- Product Info -->
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title">{{ $product->getName() }}</h5>
                                    <p class="card-text text-muted flex-grow-1">
                                        {{ Str::limit($product->getDescription(), 100) }}
                                    </p>
                                    
                                    <!-- Price -->
                                    <div class="mb-3">
                                        <span class="h4 text-success fw-bold">
                                            {{ number_format($product->getPrice(), 0, ',', '.') }} {{ __('app.common.currency') }}
                                        </span>
                                    </div>
                                    
                                    <!-- Stock Info -->
                                    <div class="mb-3">
                                        <small class="text-muted">
                                            {{ __('app.products.show.stock') }}: 
                                            <span class="fw-bold {{ $product->getStock() > 10 ? 'text-success' : ($product->getStock() > 0 ? 'text-warning' : 'text-danger') }}">
                                                {{ $product->getStock() }}
                                            </span>
                                        </small>
                                    </div>
                                </div>

                                <!-- Product Actions -->
                                <div class="card-footer bg-transparent">
                                    <div class="d-grid gap-2">
                                        <a href="{{ route('product.show', $product->getId()) }}" 
                                           class="btn btn-outline-primary">
                                            <i class="fas fa-eye me-2"></i>{{ __('app.products.show.title') }}
                                        </a>
                                        
                                        @if($product->isInStock())
                                            <form method="POST" action="{{ route('cart.add') }}">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product->getId() }}">
                                                <input type="hidden" name="quantity" value="1">
                                                <button type="submit" class="btn btn-success">
                                                    <i class="fas fa-shopping-cart me-2"></i>{{ __('app.products.actions.add_to_cart') }}
                                                </button>
                                            </form>
                                        @else
                                            <button class="btn btn-secondary" disabled>
                                                <i class="fas fa-ban me-2"></i>{{ __('app.products.show.out_of_stock') }}
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- No Products Found -->
                <div class="row">
                    <div class="col-12">
                        <div class="text-center py-5">
                            <div class="mb-4">
                                <i class="fas fa-paw fa-4x text-muted"></i>
                            </div>
                            <h3 class="text-muted">{{ __('app.products.list.no_products') }}</h3>
                            <p class="text-muted mb-4">{{ __('app.products.list.subtitle') }}</p>
                            <a href="{{ route('product.index') }}" class="btn btn-primary">
                                <i class="fas fa-arrow-left me-2"></i>{{ __('app.products.list.all_categories') }}
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

@endsection
