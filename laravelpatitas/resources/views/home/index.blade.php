@extends('layouts.app')
@section('title', 'Patitas - Tu tienda de productos para mascotas')
@section('content')

<!-- Hero Section -->
<div class="bg-primary text-white py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-4">¡Bienvenido a Patitas! 🐾</h1>
                <p class="lead mb-4">
                    La mejor tienda online para tu mascota. Encuentra todo lo que necesitas: 
                    alimentos, juguetes, medicina y accesorios de la más alta calidad.
                </p>
                <div class="d-grid gap-2 d-md-flex">
                    <a href="{{ route('product.index') }}" class="btn btn-light btn-lg me-md-2">
                        <i class="fas fa-shopping-bag me-2"></i>
                        Ver Productos
                    </a>
                    <a href="{{ route('veterinary-appointment.index') }}" class="btn btn-outline-light btn-lg">
                        <i class="fas fa-calendar-alt me-2"></i>
                        Citas Veterinarias
                    </a>
                </div>
            </div>
            <div class="col-lg-6 text-center">
                <img src="{{ asset('images/logo.png') }}" alt="Patitas Logo" class="img-fluid" style="max-width: 300px;">
            </div>
        </div>
    </div>
</div>

<!-- Features Section -->
<div class="py-5">
    <div class="container">
        <div class="row text-center mb-5">
            <div class="col-12">
                <h2 class="fw-bold">¿Por qué elegir Patitas?</h2>
                <p class="lead text-muted">Cuidamos de tu mascota como si fuera nuestra familia</p>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-3 mb-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center">
                        <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                            <i class="fas fa-heart fa-2x"></i>
                        </div>
                        <h5 class="card-title">Productos de Calidad</h5>
                        <p class="card-text text-muted">Seleccionamos cuidadosamente cada producto para garantizar la salud y felicidad de tu mascota.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3 mb-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center">
                        <div class="bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                            <i class="fas fa-truck fa-2x"></i>
                        </div>
                        <h5 class="card-title">Envío Rápido</h5>
                        <p class="card-text text-muted">Entrega a domicilio en tiempo récord. Porque sabemos que tu mascota no puede esperar.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3 mb-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center">
                        <div class="bg-info text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                            <i class="fas fa-user-md fa-2x"></i>
                        </div>
                        <h5 class="card-title">Servicios Veterinarios</h5>
                        <p class="card-text text-muted">Agenda citas con veterinarios profesionales. Cuidado médico experto para tu compañero.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3 mb-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center">
                        <div class="bg-warning text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                            <i class="fas fa-phone fa-2x"></i>
                        </div>
                        <h5 class="card-title">Soporte 24/7</h5>
                        <p class="card-text text-muted">Nuestro equipo está disponible para ayudarte en cualquier momento. Tu tranquilidad es nuestra prioridad.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Categories Section -->
<div class="bg-light py-5">
    <div class="container">
        <div class="row text-center mb-5">
            <div class="col-12">
                <h2 class="fw-bold">Nuestras Categorías</h2>
                <p class="lead text-muted">Encuentra exactamente lo que buscas</p>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6 col-lg-3 mb-4">
                <a href="{{ route('product.index', ['category' => 'Alimento']) }}" class="text-decoration-none">
                    <div class="card h-100 border-0 shadow-sm hover-shadow">
                        <div class="card-body text-center py-4">
                            <div class="text-primary mb-3">
                                <i class="fas fa-bone fa-3x"></i>
                            </div>
                            <h5 class="card-title">Alimentos</h5>
                            <p class="card-text text-muted">Concentrados, treats y suplementos nutritivos</p>
                        </div>
                    </div>
                </a>
            </div>
            
            <div class="col-md-6 col-lg-3 mb-4">
                <a href="{{ route('product.index', ['category' => 'Juguetes']) }}" class="text-decoration-none">
                    <div class="card h-100 border-0 shadow-sm hover-shadow">
                        <div class="card-body text-center py-4">
                            <div class="text-success mb-3">
                                <i class="fas fa-futbol fa-3x"></i>
                            </div>
                            <h5 class="card-title">Juguetes</h5>
                            <p class="card-text text-muted">Pelotas, cuerdas y juguetes interactivos</p>
                        </div>
                    </div>
                </a>
            </div>
            
            <div class="col-md-6 col-lg-3 mb-4">
                <a href="{{ route('product.index', ['category' => 'Medicina']) }}" class="text-decoration-none">
                    <div class="card h-100 border-0 shadow-sm hover-shadow">
                        <div class="card-body text-center py-4">
                            <div class="text-danger mb-3">
                                <i class="fas fa-pills fa-3x"></i>
                            </div>
                            <h5 class="card-title">Medicina</h5>
                            <p class="card-text text-muted">Vitaminas, antiparasitarios y shampoos</p>
                        </div>
                    </div>
                </a>
            </div>
            
            <div class="col-md-6 col-lg-3 mb-4">
                <a href="{{ route('product.index', ['category' => 'Accesorios']) }}" class="text-decoration-none">
                    <div class="card h-100 border-0 shadow-sm hover-shadow">
                        <div class="card-body text-center py-4">
                            <div class="text-warning mb-3">
                                <i class="fas fa-collar fa-3x"></i>
                            </div>
                            <h5 class="card-title">Accesorios</h5>
                            <p class="card-text text-muted">Collares, correas, camas y transportadores</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- CTA Section -->
<div class="bg-primary text-white py-5">
    <div class="container text-center">
        <h2 class="fw-bold mb-4">¿Listo para cuidar mejor a tu mascota?</h2>
        <p class="lead mb-4">Explora nuestro catálogo completo y encuentra todo lo que necesitas</p>
        <a href="{{ route('product.index') }}" class="btn btn-light btn-lg">
            <i class="fas fa-paw me-2"></i>
            Explorar Productos
        </a>
    </div>
</div>

@endsection

@section('styles')
<style>
    .hover-shadow {
        transition: all 0.3s ease;
    }
    .hover-shadow:hover {
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
        transform: translateY(-2px);
    }
</style>
@endsection
