<!doctype html>

<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous" />
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet" />
    <title>@yield('title', 'Admin - Patitas')</title>

</head>

<body>
    <!-- header -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark py-1">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('images/logo.png') }}" alt="logo" width="55" height="55"
                    class="d-inline-block align-text-center">
                <span class="fs-1">Patitas Admin</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav me-auto">
                    <a class="nav-link" href="{{ route('admin.index') }}">{{ __('admin.navigation.dashboard') }}</a>
                    <a class="nav-link"
                        href="{{ route('admin.product.index') }}">{{ __('admin.navigation.products') }}</a>
                    <a class="nav-link" href="#">{{ __('admin.navigation.users') }}</a>
                    <a class="nav-link" href="#">{{ __('admin.navigation.orders') }}</a>
                </div>
                <div class="navbar-nav">
                    <form id="logout" action="{{ route('logout') }}" method="POST">
                        <a role="button" class="nav-link"
                            onclick="document.getElementById('logout').submit();">{{ __('admin.navigation.logout') }}</a>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <header class="bg-primary text-white py-3">
        <div class="container">
            <h1 class="mb-0">@yield('title', 'Panel Administrativo')</h1>
            @hasSection('subtitle')
                <p class="mb-0 mt-1">@yield('subtitle')</p>
            @endif
        </div>
    </header>
    <!-- header -->

    <div class="container-fluid my-4">
        @yield('content')
    </div>

    <!-- footer -->
    <footer class="bg-dark text-white py-3 mt-auto">
        <div class="container text-center">
            <small>
                Patitas Admin Panel &copy; {{ date('Y') }}
            </small>
        </div>
    </footer>
    <!-- footer -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
</body>

</html>
