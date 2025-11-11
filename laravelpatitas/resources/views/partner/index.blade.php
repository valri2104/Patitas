@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="row mb-4">
            <div class="col">
                <h1 class="mb-1">{{ $viewData['title'] }}</h1>
                <p class="text-muted">{{ $viewData['subtitle'] }}</p>
            </div>
        </div>

        @if ($viewData['apiAvailable'])
            <div class="row">
                @forelse ($viewData['products'] as $product)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card h-100">
                            <div class="card-body d-flex flex-column justify-content-between">
                                <h5 class="card-title">{{ $product['name'] }}</h5>
                                @if (! empty($product['id']))
                                    <p class="card-text text-muted">{{ __('partners.fields.identifier', ['id' => $product['id']]) }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info" role="alert">
                            {{ __('partners.messages.empty') }}
                        </div>
                    </div>
                @endforelse
            </div>
        @else
            <div class="alert alert-warning" role="alert">
                {{ $viewData['errorMessage'] }}
            </div>
        @endif
    </div>
@endsection

