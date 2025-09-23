@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="mb-4">
                            <i class="fas fa-check-circle fa-4x text-success mb-3"></i>
                            <h1 class="text-success">{{ __('cart.purchase_success') }}</h1>
                        </div>
                        
                        @if(isset($viewData['orderId']))
                            <div class="alert alert-info">
                                <h5 class="alert-heading">
                                    <i class="fas fa-receipt me-2"></i>{{ __('cart.order_details') }}
                                </h5>
                                <p class="mb-2">
                                    <strong>{{ __('cart.order_id') }}:</strong> 
                                    <span class="badge bg-primary fs-6">#{{ $viewData['orderId'] }}</span>
                                </p>
                                <p class="mb-0">
                                    <strong>{{ __('cart.order_date') }}:</strong> 
                                    {{ $viewData['orderDate'] }}
                                </p>
                            </div>
                        @endif
                        
                        <div class="alert alert-light">
                            <h6 class="alert-heading">
                                <i class="fas fa-info-circle me-2"></i>{{ __('cart.whats_next') }}
                            </h6>
                            <ul class="list-unstyled mb-0 text-start">
                                <li class="mb-2">
                                    <i class="fas fa-envelope text-primary me-2"></i>
                                    {{ __('cart.email_confirmation') }}
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-truck text-primary me-2"></i>
                                    {{ __('cart.processing_time') }}
                                </li>
                                <li class="mb-0">
                                    <i class="fas fa-phone text-primary me-2"></i>
                                    {{ __('cart.contact_support') }}
                                </li>
                            </ul>
                        </div>
                        
                        <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                            <a href="{{ route('product.index') }}" class="btn btn-primary me-md-2">
                                <i class="fas fa-shopping-bag me-2"></i>{{ __('cart.continue_shopping') }}
                            </a>
                            <a href="{{ route('home.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-home me-2"></i>{{ __('cart.back_to_home') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
