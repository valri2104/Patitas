@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Mis pedidos</h2>
    @if($orders->isEmpty())
        <div class="alert alert-info">No tienes pedidos registrados.</div>
    @else
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Total</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $order->getId() }}</td>
                <td>{{ $order->getDateTime() }}</td>
                <td>{{ ucfirst($order->getStatus()) }}</td>
                <td>${{ number_format($order->getTotal(), 2) }}</td>
                <td>
                    <a href="{{ route('order.show', $order->getId()) }}" class="btn btn-sm btn-primary">Ver</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
    <a href="{{ route('order.create') }}" class="btn btn-success">Nuevo pedido</a>
</div>
@endsection
