@extends('layouts.app')

@section('content')
    <div class="banner-app">
        <div class="text-center">
            <h1>{{ $viewData['title'] }}</h1>
            <p class="lead">{{ __('app.home.welcome_message') }}</p>
            <a href="{{ route('product.index') }}" class="btn btn-primary btn-lg">
                {{ __('app.home.explore_products') }}
            </a>
        </div>
    </div>
@endsection
