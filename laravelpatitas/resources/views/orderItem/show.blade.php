@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ __('orderItems.detailTitle') }}</h2>
    @if(isset($viewData['orderItem']))
        <ul class="list-group mb-3">
            <li class="list-group-item"><strong>{{ __('orderItems.id') }}:</strong> {{ $viewData['orderItem']->getId() }}</li>
            <li class="list-group-item"><strong>{{ __('orderItems.product') }}:</strong> {{ $viewData['orderItem']->product ? $viewData['orderItem']->product->getName() : __('orderItems.deletedProduct') }}</li>
            <li class="list-group-item"><strong>{{ __('orderItems.quantity') }}:</strong> {{ $viewData['orderItem']->getQuantity() }}</li>
            <li class="list-group-item"><strong>{{ __('orderItems.unitPrice') }}:</strong> ${{ number_format($viewData['orderItem']->getUnitPrice(), 2) }}</li>
        </ul>
    @else
        <div class="alert alert-info">{{ __('orderItems.notFound') }}</div>
    @endif
</div>
@endsection
