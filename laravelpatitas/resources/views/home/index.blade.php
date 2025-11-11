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

    <!-- Weather Widget -->
    @if(isset($viewData['weather']))
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow-lg border-0">
                        <div class="card-body p-4">
                            <div class="row align-items-center">
                                <div class="col-md-3 text-center">
                                    <img src="https://openweathermap.org/img/wn/{{ $viewData['weather']['icon'] }}@4x.png" 
                                         alt="weather icon" 
                                         class="img-fluid"
                                         style="max-width: 120px;">
                                </div>
                                <div class="col-md-6">
                                    <h3 class="text-primary mb-1">
                                        <i class="fas fa-map-marker-alt me-2"></i>{{ $viewData['weather']['city'] }}
                                    </h3>
                                    <p class="text-muted mb-2 text-capitalize">{{ $viewData['weather']['description'] }}</p>
                                    <h1 class="display-3 mb-0">{{ $viewData['weather']['temperature'] }}°C</h1>
                                    <p class="text-muted">{{ __('app.weather.feels_like') }}: {{ $viewData['weather']['feels_like'] }}°C</p>
                                </div>
                                <div class="col-md-3">
                                    <div class="d-flex flex-column gap-2">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-tint text-primary me-2"></i>
                                            <span>{{ __('app.weather.humidity') }}: {{ $viewData['weather']['humidity'] }}%</span>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-wind text-primary me-2"></i>
                                            <span>{{ __('app.weather.wind') }}: {{ $viewData['weather']['wind_speed'] }} m/s</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-light text-center">
                            <small class="text-muted">
                                <i class="fas fa-info-circle me-1"></i>
                                {{ __('app.weather.powered_by') }} OpenWeatherMap
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
