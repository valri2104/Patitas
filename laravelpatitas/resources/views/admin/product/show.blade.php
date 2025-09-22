@extends('layouts.admin')

@section('title', __('admin.products.show.title', ['name' => $viewData['product']->getName()]))

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2>{{ $viewData['product']->getName() }}</h2>
            <p class="text-muted mb-0">{{ __('admin.products.show.product_information') }}</p>
        </div>
        <a href="{{ route('admin.product.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>{{ __('admin.products.actions.back_to_list') }}
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 text-center mb-4">
                    <img src="{{ $viewData['product']->getImageUrl() ?: 'https://via.placeholder.com/400x400/cccccc/666666?text=Sin+Imagen' }}" 
                         alt="{{ $viewData['product']->getName() }}" 
                         class="img-fluid rounded border">
                </div>
                
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-6">
                            <dl class="row">
                                <dt class="col-sm-4">{{ __('admin.products.form.name') }}:</dt>
                                <dd class="col-sm-8">{{ $viewData['product']->getName() }}</dd>
                                
                                <dt class="col-sm-4">{{ __('admin.products.form.category') }}:</dt>
                                <dd class="col-sm-8">
                                    <span class="badge bg-secondary">{{ __('admin.products.categories.' . $viewData['product']->getCategory()) }}</span>
                                </dd>
                                
                                <dt class="col-sm-4">{{ __('admin.products.form.price') }}:</dt>
                                <dd class="col-sm-8">
                                    <span class="fw-bold text-success">{{ number_format($viewData['product']->getPrice(), 0, ',', '.') }} {{ __('admin.common.currency') }}</span>
                                </dd>
                                
                                <dt class="col-sm-4">{{ __('admin.products.form.stock') }}:</dt>
                                <dd class="col-sm-8">
                                    <span class="badge {{ $viewData['product']->getStock() > 10 ? 'bg-success' : ($viewData['product']->getStock() > 0 ? 'bg-warning' : 'bg-danger') }}">
                                        {{ $viewData['product']->getStock() }}
                                    </span>
                                </dd>
                            </dl>
                        </div>
                        
                        <div class="col-md-6">
                            <dl class="row">
                                <dt class="col-sm-4">{{ __('admin.products.table.status') }}:</dt>
                                <dd class="col-sm-8">
                                    @if($viewData['product']->isInStock())
                                        <span class="badge bg-success">{{ __('admin.products.table.in_stock') }}</span>
                                    @else
                                        <span class="badge bg-danger">{{ __('admin.products.table.out_of_stock') }}</span>
                                    @endif
                                </dd>
                                
                                <dt class="col-sm-4">{{ __('admin.products.form.customizable') }}:</dt>
                                <dd class="col-sm-8">
                                    <span class="badge {{ $viewData['product']->getCustomizable() ? 'bg-info' : 'bg-secondary' }}">
                                        {{ $viewData['product']->getCustomizable() ? __('admin.common.yes') : __('admin.common.no') }}
                                    </span>
                                </dd>
                                
                                <dt class="col-sm-4">{{ __('admin.products.show.created_at') }}:</dt>
                                <dd class="col-sm-8">{{ date('d/m/Y H:i', strtotime($viewData['product']->getCreatedAt())) }}</dd>
                                
                                <dt class="col-sm-4">{{ __('admin.products.show.updated_at') }}:</dt>
                                <dd class="col-sm-8">{{ date('d/m/Y H:i', strtotime($viewData['product']->getUpdatedAt())) }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row mt-3">
                <div class="col-12">
                    <dt>{{ __('admin.products.form.description') }}:</dt>
                    <dd class="mt-2">{{ $viewData['product']->getDescription() }}</dd>
                </div>
            </div>
            
            <div class="d-flex justify-content-end gap-2 mt-4">
                <a href="{{ route('admin.product.index') }}" class="btn btn-secondary">
                    <i class="fas fa-list me-2"></i>{{ __('admin.products.actions.back_to_list') }}
                </a>
                <a href="{{ route('admin.product.edit', $viewData['product']->getId()) }}" class="btn btn-warning">
                    <i class="fas fa-edit me-2"></i>{{ __('admin.products.actions.edit') }}
                </a>
                <form action="{{ route('admin.product.destroy', $viewData['product']->getId()) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este producto?')">
                        <i class="fas fa-trash me-2"></i>{{ __('admin.products.actions.delete') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection