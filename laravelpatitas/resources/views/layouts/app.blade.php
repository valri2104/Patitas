<!doctype html>

<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet" />
    <title>@yield('title', __('app.layouts.app.title'))</title>

</head>

<body>
    <!-- header -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary py-1">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home.index') }}">
                <img src="{{ asset('images/logo.png') }}" alt="logo" width="55" height="55"
                    class="d-inline-block align-text-center">
                <span class="fs-1">{{ __('app.layouts.app.subtitle') }}</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ms-auto align-items-lg-center">
                    <a class="nav-link active"
                        href="{{ route('product.index') }}">{{ __('app.navigation.products') }}</a>
                    <a class="nav-link active" href="{{ route('cart.index') }}">{{ __('app.navigation.cart') }}</a>
                    
                    @auth
                        <a class="nav-link active" href="{{ route('appointment.index') }}">
                            <i class="fas fa-calendar-check me-1"></i>{{ __('app.navigation.appointments') }}
                        </a>
                        <a class="nav-link active" href="{{ route('order.index') }}">
                            <i class="fas fa-shopping-bag me-1"></i>{{ __('app.navigation.orders') }}
                        </a>
                    @endauth

                    @auth
                        @php
                            $user = auth()->user();
                            $formattedBalance = number_format($user->getBalance(), 0, ',', '.');
                            $balanceClass = $user->getBalance() > 100000 ? 'bg-success' : 'bg-warning text-dark';
                        @endphp
                        <span class="badge {{ $balanceClass }} ms-lg-3 my-2 my-lg-0">
                            <i class="fas fa-wallet me-1"></i>
                            {{ __('app.navigation.balance') }}: ${{ $formattedBalance }} {{ __('app.common.currency') }}
                        </span>
                    @endauth

                    <div class="vr bg-white mx-2 d-none d-lg-block"></div>
                    @guest
                        <a class="nav-link active" href="{{ route('login') }}">{{ __('app.navigation.login') }}</a>
                        <a class="nav-link active" href="{{ route('register') }}">{{ __('app.navigation.register') }}</a>
                    @else
                        <form id="logout" action="{{ route('logout') }}" method="POST" class="mb-0">
                            @csrf
                            <a role="button" class="nav-link active"
                                onclick="document.getElementById('logout').submit();">{{ __('app.navigation.logout') }}</a>
                        </form>
                    @endguest
                </div>
            </div>
        </div>
    </nav>


    <!-- header -->

    <div class="container my-4">
        @yield('content')
    </div>

    <!-- footer -->
    <div class="copyright py-4 text-center text-white">
        <div class="container">
            <small>

                </a>
            </small>
        </div>
    </div>
    <!-- footer -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
</body>

</html>
