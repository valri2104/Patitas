@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ __('orderItems.title') }}</h2>
    @if(isset($viewData['orderItems']) && count($viewData['orderItems']) > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>{{ __('orderItems.id') }}</th>
                    <th>{{ __('orderItems.product') }}</th>
                    <th>{{ __('orderItems.quantity') }}</th>
                    <th>{{ __('orderItems.unitPrice') }}</th>
                    <th>{{ __('orderItems.actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($viewData['orderItems'] as $item)
                    <tr>
                        <td>{{ $item->getId() }}</td>
                        <td>{{ $item->product ? $item->product->getName() : __('orderItems.deletedProduct') }}</td>
                        <td>{{ $item->getQuantity() }}</td>
                        <td>${{ number_format($item->getUnitPrice(), 2) }}</td>
                        <td>
                            <a href="{{ route('orderItem.show', $item->getId()) }}" class="btn btn-sm btn-primary">{{ __('orderItems.view') }}</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="alert alert-info">{{ __('orderItems.empty') }}</div>
    @endif
</div>
@endsection
