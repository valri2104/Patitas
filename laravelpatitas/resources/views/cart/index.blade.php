@extends('layouts.app')

@section('content')
    <div class="container mt-4" data-confirm-remove="{{ __('cart.confirm_remove') }}">
        <h1>{{ $viewData['title'] }}</h1>
        
        @if(count($viewData['cartProducts']) > 0)
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">{{ __('cart.products_in_cart') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>{{ __('products.name') }}</th>
                                            <th>{{ __('products.price') }}</th>
                                            <th>{{ __('cart.quantity') }}</th>
                                            <th>{{ __('cart.subtotal') }}</th>
                                            <th>{{ __('cart.actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($viewData['cartProducts'] as $item)
                                            <tr>
                                                <td class="align-middle" style="width: 90px;">
                                                    <img src="{{ $item['product']->getImageUrl() }}" alt="{{ $item['product']->getName() }}" class="img-fluid rounded" />
                                                </td>
                                                <td class="align-middle">
                                                    <strong>{{ $item['product']->getName() }}</strong>
                                                    @if($item['product']->getStock() < $item['quantity'])
                                                        <span class="badge bg-warning text-dark ms-2">{{ __('cart.low_stock') }}</span>
                                                    @endif
                                                </td>
                                                <td>${{ $item['productPriceFormatted'] }}</td>
                                                <td>
                                                    <form method="POST" action="{{ route('cart.updateQuantity') }}" class="d-flex align-items-center">
                                                        @csrf
                                                        <input type="hidden" name="product_id" value="{{ $item['product']->getId() }}">
                                                        <input type="number" name="quantity" value="{{ $item['quantity'] }}" 
                                                               min="1" max="{{ $item['product']->getStock() }}" 
                                                               class="form-control form-control-sm me-2" style="width: 80px;">
                                                        <button type="submit" class="btn btn-outline-primary btn-sm me-2">
                                                            {{ __('cart.update') }}
                                                        </button>
                                                    </form>
                                                </td>
                                                <td><strong>${{ $item['subtotalFormatted'] }}</strong></td>
                                                <td>
                                                    <form method="POST" action="{{ route('cart.remove') }}" class="d-inline js-remove-form">
                                                        @csrf
                                                        <input type="hidden" name="product_id" value="{{ $item['product']->getId() }}">
                                                        <button type="submit" class="btn btn-outline-danger btn-sm">
                                                            {{ __('cart.remove') }}
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">{{ __('cart.order_summary') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-2">
                                <span>{{ __('cart.subtotal') }}:</span>
                                <span>${{ $viewData['totalAmountFormatted'] }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>{{ __('cart.shipping') }}:</span>
                                <span>{{ __('cart.free') }}</span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between mb-3">
                                <strong>{{ __('cart.total') }}:</strong>
                                <strong class="text-primary">${{ $viewData['totalAmountFormatted'] }}</strong>
                            </div>
                            
                            @auth
                                <div class="mb-3">
                                    <label for="delivery_address" class="form-label">{{ __('cart.delivery_address') }}</label>
                                    <textarea class="form-control" id="delivery_address" name="delivery_address" 
                                              rows="3" placeholder="{{ __('cart.address_placeholder') }}">{{ $viewData['prefilledAddress'] }}</textarea>
                                    <small class="form-text text-muted">{{ __('cart.address_help') }}</small>
                                </div>
                                
                                <form method="POST" action="{{ route('cart.purchase') }}">
                                    @csrf
                                    <input type="hidden" name="delivery_address" id="delivery_address_input">
                                    <button type="submit" class="btn btn-success w-100" onclick="setDeliveryAddress()">
                                        <i class="fas fa-shopping-cart me-2"></i>{{ __('cart.proceed_to_checkout') }}
                                    </button>
                                </form>
                            @else
                                <div class="alert alert-warning">
                                    <i class="fas fa-exclamation-triangle me-2"></i>
                                    {{ __('cart.login_required_message') }}
                                </div>
                                <a href="{{ route('login') }}" class="btn btn-primary w-100">
                                    {{ __('cart.login_to_purchase') }}
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-shopping-cart fa-3x text-muted mb-3"></i>
                <h3 class="text-muted">{{ __('cart.empty') }}</h3>
                <p class="text-muted">{{ __('cart.empty_message') }}</p>
                <a href="{{ route('product.index') }}" class="btn btn-primary">
                    <i class="fas fa-arrow-left me-2"></i>{{ __('cart.back_to_products') }}
                </a>
            </div>
        @endif
    </div>

    <script>
        const cartRoot = document.querySelector('[data-confirm-remove]');
        const CART_CONFIRM_REMOVE = cartRoot ? cartRoot.getAttribute('data-confirm-remove') : '';
        function setDeliveryAddress() {
            const textarea = document.getElementById('delivery_address');
            const input = document.getElementById('delivery_address_input');
            if (textarea && input) {
                input.value = textarea.value;
            }
        }
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.js-remove-form').forEach(function(form) {
                form.addEventListener('submit', function (e) {
                    if (!confirm(CART_CONFIRM_REMOVE)) {
                        e.preventDefault();
                    }
                });
            });
        });
    </script>
@endsection
