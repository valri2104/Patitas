@extends('layouts.app')

@section('content')
	<div class="container mt-4">
		<h1>{{ $viewData['title'] }}</h1>
		<div class="alert alert-success mt-3">{{ __('cart.purchase_success') }}</div>
		<h4 class="mt-4">{{ __('cart.purchased_products') }}</h4>
		<ul class="list-group mt-2">
			@foreach($viewData['cartProducts'] as $item)
				<li class="list-group-item d-flex justify-content-between align-items-center">
					{{ $item['product']->getName() }}
					<span class="badge bg-primary rounded-pill">{{ $item['quantity'] }}</span>
				</li>
			@endforeach
		</ul>
	</div>
@endsection
