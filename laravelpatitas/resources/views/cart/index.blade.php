@extends('layouts.app')

@section('content')
	<div class="container mt-4">
		<h1>{{ $viewData['title'] }}</h1>
		@if(count($viewData['cartProducts']) > 0)
			<table class="table table-bordered mt-3">
				<thead>
					<tr>
						<th>{{ __('products.name') }}</th>
						<th>{{ __('products.price') }}</th>
						<th>{{ __('cart.quantity') }}</th>
						<th>{{ __('cart.actions') }}</th>
					</tr>
				</thead>
				<tbody>
					@foreach($viewData['cartProducts'] as $item)
						<tr>
							<td>{{ $item['product']->getName() }}</td>
							<td>${{ number_format($item['product']->getPrice(), 2) }}</td>
							<td>{{ $item['quantity'] }}</td>
							<td>
								<form method="POST" action="{{ route('cart.remove') }}">
									@csrf
									<input type="hidden" name="product_id" value="{{ $item['product']->getId() }}">
									<button type="submit" class="btn btn-danger btn-sm">{{ __('cart.remove') }}</button>
								</form>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
			<a href="{{ route('cart.purchase') }}" class="btn btn-success mt-3">{{ __('cart.purchase') }}</a>
		@else
			<div class="alert alert-info mt-3">{{ __('cart.empty') }}</div>
		@endif
	</div>
@endsection
