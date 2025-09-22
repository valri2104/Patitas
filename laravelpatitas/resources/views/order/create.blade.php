@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Crear Pedido</h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('order.store') }}">
        @csrf
        <div class="mb-3">
            <label for="delivery_address" class="form-label">Dirección de entrega</label>
            <input type="text" class="form-control" id="delivery_address" name="delivery_address" required>
        </div>
        <div class="mb-3">
            <label for="notes" class="form-label">Notas (opcional)</label>
            <textarea class="form-control" id="notes" name="notes"></textarea>
        </div>
        <h4>Productos</h4>
        <div id="items-container">
            <div class="row mb-2 item-row">
                <div class="col-md-6">
                    <select name="items[0][product_id]" class="form-select" required>
                        <option value="">Seleccione producto</option>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }} (Stock: {{ $product->stock }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <input type="number" name="items[0][quantity]" class="form-control" min="1" value="1" required>
                </div>
                <div class="col-md-3">
                    <button type="button" class="btn btn-danger remove-item">Eliminar</button>
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-secondary mb-3" id="add-item">Agregar producto</button>
        <br>
        <button type="submit" class="btn btn-primary">Crear Pedido</button>
    </form>
</div>
<script>
    let itemIndex = 1;
    document.getElementById('add-item').addEventListener('click', function() {
        const container = document.getElementById('items-container');
        const row = document.createElement('div');
        row.className = 'row mb-2 item-row';
        row.innerHTML = `
            <div class="col-md-6">
                <select name="items[${itemIndex}][product_id]" class="form-select" required>
                    <option value="">Seleccione producto</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }} (Stock: {{ $product->stock }})</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <input type="number" name="items[${itemIndex}][quantity]" class="form-control" min="1" value="1" required>
            </div>
            <div class="col-md-3">
                <button type="button" class="btn btn-danger remove-item">Eliminar</button>
            </div>
        `;
        container.appendChild(row);
        itemIndex++;
    });
    document.addEventListener('click', function(e) {
        if (e.target && e.target.classList.contains('remove-item')) {
            e.target.closest('.item-row').remove();
        }
    });
</script>
@endsection
