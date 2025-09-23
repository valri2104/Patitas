@extends('layouts.app')

@section('content')
	<div class="container mt-4">
		<h1>{{ $viewData['title'] }}</h1>
		<div class="alert alert-success mt-3">{{ __('cart.purchase_success') }}</div>
		
		@if(isset($viewData['orderId']))
			<div class="alert alert-info mt-3">
				<strong>{{ __('cart.order_id') }}:</strong> #{{ $viewData['orderId'] }}
			</div>
		@endif
		
		<a href="{{ route('product.index') }}" class="btn btn-primary mt-3">{{ __('cart.back_to_products') }}</a>
	</div>
@endsection
