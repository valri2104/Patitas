@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detalle del Pedido #{{ $order->getId() }}</h2>
    <div class="mb-3">
        <strong>Estado:</strong> {{ ucfirst($order->getStatus()) }}<br>
        <strong>Fecha:</strong> {{ $order->getDateTime() }}<br>
        <strong>Dirección de entrega:</strong> {{ $order->getDeliveryAddress() }}<br>
        @if ($order->getNotes())
            <strong>Notas:</strong> {{ $order->getNotes() }}<br>
        @endif
        <strong>Total:</strong> ${{ number_format($order->getTotal(), 2) }}
    </div>
    <h4>Productos</h4>
    <table class="table">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio unitario</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->orderItems as $item)
                <tr>
                    <td>{{ $item->product->name ?? 'Producto eliminado' }}</td>
                    <td>{{ $item->getQuantity() }}</td>
                    <td>${{ number_format($item->getUnitPrice(), 2) }}</td>
                    <td>${{ number_format($item->getUnitPrice() * $item->getQuantity(), 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('home') }}" class="btn btn-secondary">Volver al inicio</a>
</div>
@endsection
