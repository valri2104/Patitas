@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
    <div class="container my-4">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="fw-bold">{{ $viewData['title'] }}</h1>
                <p class="lead">{{ $viewData['subtitle'] }}</p>
                
                <!-- Category Filter -->
                <div class="row mb-4">
                    <div class="col-md-12">
                        <form method="GET" action="{{ route('product.index') }}">
                            <div class="row align-items-end">
                                <div class="col-md-4">
                                    <label for="category" class="form-label">{{ __('messages.filter_by_category') }}</label>
                                    <select class="form-select" id="category" name="category">
                                        <option value="">{{ __('messages.all_categories') }}</option>
                                        <option value="Alimento" {{ request('category') === 'Alimento' ? 'selected' : '' }}>
                                            {{ __('messages.food') }}
                                        </option>
                                        <option value="Juguetes" {{ request('category') === 'Juguetes' ? 'selected' : '' }}>
                                            {{ __('messages.toys') }}
                                        </option>
                                        <option value="Medicina" {{ request('category') === 'Medicina' ? 'selected' : '' }}>
                                            {{ __('messages.medicine') }}
                                        </option>
                                        <option value="Accesorios" {{ request('category') === 'Accesorios' ? 'selected' : '' }}>
                                            {{ __('messages.accessories') }}
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary">{{ __('messages.filter') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Products Grid -->
                <div class="row">
                    @forelse($viewData['products'] as $product)
                        <div class="col-md-4 col-lg-3 mb-4">
                            <div class="card h-100">
                                @if($product->getImageUrl())
                                    <img src="{{ $product->getImageUrl() }}" class="card-img-top" alt="{{ $product->getName() }}" style="height: 200px; object-fit: cover;">
                                @else
                                    <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                        <i class="fas fa-image text-muted fa-3x"></i>
                                    </div>
                                @endif
                                
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title">{{ $product->getName() }}</h5>
                                    <p class="card-text flex-grow-1">{{ Str::limit($product->getDescription(), 100) }}</p>
                                    
                                    <div class="mt-auto">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span class="h5 mb-0 text-primary">${{ number_format($product->getPrice(), 2) }}</span>
                                            <small class="text-muted">{{ $product->getCategory() }}</small>
                                        </div>
                                        
                                        <div class="d-flex justify-content-between align-items-center">
                                            <small class="text-muted">
                                                @if($product->getStock() > 0)
                                                    <span class="badge bg-success">{{ __('messages.in_stock') }} ({{ $product->getStock() }})</span>
                                                @else
                                                    <span class="badge bg-danger">{{ __('messages.out_of_stock') }}</span>
                                                @endif
                                            </small>
                                            
                                            <a href="{{ route('product.show', $product->getId()) }}" class="btn btn-primary btn-sm">
                                                {{ __('messages.view_details') }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="alert alert-info text-center">
                                <h4>{{ __('messages.no_products_found') }}</h4>
                                <p>{{ __('messages.no_products_message') }}</p>
                            </div>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination if needed -->
                @if(method_exists($viewData['products'], 'links'))
                    <div class="row">
                        <div class="col-12 d-flex justify-content-center">
                            {{ $viewData['products']->links() }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection