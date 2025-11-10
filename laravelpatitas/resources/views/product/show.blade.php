@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i>{{ __('app.products.reviews.messages.validation_error') }}
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Breadcrumb Navigation -->
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home.index') }}">{{ __('app.navigation.home') }}</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('product.index') }}">{{ __('app.navigation.products') }}</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ $viewData['product']->getName() }}
                    </li>
                </ol>
            </nav>

            <!-- Product Details Card -->
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="row">
                        <!-- Product Image -->
                        <div class="col-lg-5 col-md-6 mb-4">
                            <div class="text-center">
                                <img src="{{ $viewData['product']->getImageUrl() ?: 'https://via.placeholder.com/500x500/cccccc/666666?text=Sin+Imagen' }}" 
                                     alt="{{ $viewData['product']->getName() }}" 
                                     class="img-fluid rounded border shadow-sm product-detail-image">
                                
                                <!-- Category Badge -->
                                <div class="mt-3">
                                    <span class="badge bg-primary fs-6 px-3 py-2">
                                        {{ __('app.products.categories.' . $viewData['product']->getCategory()) }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Product Information -->
                        <div class="col-lg-7 col-md-6">
                            <!-- Product Title -->
                            <h1 class="display-5 fw-bold text-primary mb-3">
                                {{ $viewData['product']->getName() }}
                            </h1>

                            <!-- Price -->
                            <div class="mb-4">
                                <span class="display-6 fw-bold text-success">
                                    {{ number_format($viewData['product']->getPrice(), 0, ',', '.') }} {{ __('app.common.currency') }}
                                </span>
                            </div>

                            <!-- Product Details -->
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <!-- Stock Status -->
                                    <div class="mb-3">
                                        <h6 class="text-muted mb-2">{{ __('app.products.show.stock') }}</h6>
                                        @if($viewData['product']->isInStock())
                                            <span class="badge bg-success fs-6 px-3 py-2">
                                                <i class="fas fa-check-circle me-1"></i>
                                                {{ __('app.products.show.in_stock') }}
                                            </span>
                                            <div class="text-muted small mt-1">
                                                {{ trans_choice('app.products.show.units_available', $viewData['product']->getStock(), ['count' => $viewData['product']->getStock()]) }}
                                            </div>
                                        @else
                                            <span class="badge bg-danger fs-6 px-3 py-2">
                                                <i class="fas fa-times-circle me-1"></i>
                                                {{ __('app.products.show.out_of_stock') }}
                                            </span>
                                        @endif
                                    </div>

                                    <!-- Category -->
                                    <div class="mb-3">
                                        <h6 class="text-muted mb-2">{{ __('app.products.show.category') }}</h6>
                                        <span class="badge bg-secondary fs-6 px-3 py-2">
                                            {{ __('app.products.categories.' . $viewData['product']->getCategory()) }}
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <!-- Customizable -->
                                    <div class="mb-3">
                                        <h6 class="text-muted mb-2">{{ __('app.products.show.customizable') }}</h6>
                                        <span class="badge {{ $viewData['product']->getCustomizable() ? 'bg-info' : 'bg-secondary' }} fs-6 px-3 py-2">
                                            {{ $viewData['product']->getCustomizable() ? __('app.common.yes') : __('app.common.no') }}
                                        </span>
                                    </div>

                                    <!-- Price Display -->
                                    <div class="mb-3">
                                        <h6 class="text-muted mb-2">{{ __('app.products.show.price') }}</h6>
                                        <div class="h5 text-success fw-bold">
                                            {{ number_format($viewData['product']->getPrice(), 0, ',', '.') }} {{ __('app.common.currency') }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="d-grid gap-2 d-md-flex justify-content-md-start mb-4">
                                @if($viewData['product']->isInStock())
                                    <form method="POST" action="{{ route('cart.add') }}">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $viewData['product']->getId() }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="btn btn-success btn-lg flex-md-fill me-md-2">
                                            <i class="fas fa-shopping-cart me-2"></i>
                                            {{ __('app.products.actions.add_to_cart') }}
                                        </button>
                                    </form>
                                @else
                                    <button class="btn btn-secondary btn-lg flex-md-fill me-md-2" disabled>
                                        <i class="fas fa-ban me-2"></i>
                                        {{ __('app.products.show.out_of_stock') }}
                                    </button>
                                @endif
                                
                                <a href="{{ route('product.index') }}" class="btn btn-outline-primary btn-lg flex-md-fill">
                                    <i class="fas fa-arrow-left me-2"></i>
                                    {{ __('app.products.show.back_to_catalog') }}
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Product Description -->
                    @if($viewData['product']->getDescription())
                        <div class="row mt-5">
                            <div class="col-12">
                                <div class="border-top pt-4">
                                    <h3 class="h4 text-primary mb-3">
                                        <i class="fas fa-info-circle me-2"></i>
                                        {{ __('app.products.show.description') }}
                                    </h3>
                                    <div class="lead text-muted">
                                        {{ $viewData['product']->getDescription() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Additional Product Information -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="border-top pt-4">
                                <h4 class="text-primary mb-3">
                                    <i class="fas fa-clipboard-list me-2"></i>
                                    {{ __('app.products.show.additional_info') }}
                                </h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card bg-light">
                                            <div class="card-body">
                                                <h6 class="card-title text-muted">{{ __('app.products.show.product_details') }}</h6>
                                                <ul class="list-unstyled mb-0">
                                                    <li><strong>{{ __('app.products.show.category') }}:</strong> {{ __('app.products.categories.' . $viewData['product']->getCategory()) }}</li>
                                                    <li><strong>{{ __('app.products.show.stock') }}:</strong> {{ $viewData['product']->getStock() }} {{ __('app.products.show.units') }}</li>
                                                    <li><strong>{{ __('app.products.show.customizable') }}:</strong> {{ $viewData['product']->getCustomizable() ? __('app.common.yes') : __('app.common.no') }}</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card bg-light">
                                            <div class="card-body">
                                                <h6 class="card-title text-muted">{{ __('app.products.show.purchase_info') }}</h6>
                                                <ul class="list-unstyled mb-0">
                                                    <li><strong>{{ __('app.products.show.price') }}:</strong> {{ number_format($viewData['product']->getPrice(), 0, ',', '.') }} {{ __('app.common.currency') }}</li>
                                                    <li><strong>{{ __('app.products.show.availability') }}:</strong> 
                                                        @if($viewData['product']->isInStock())
                                                            <span class="text-success">{{ __('app.products.show.in_stock') }}</span>
                                                        @else
                                                            <span class="text-danger">{{ __('app.products.show.out_of_stock') }}</span>
                                                        @endif
                                                    </li>
                                                    <li><strong>{{ __('app.products.show.shipping') }}:</strong> {{ __('app.products.show.free_shipping') }}</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

            <!-- Product Reviews -->
            <div class="row mt-5">
                <div class="col-12">
                    <div class="border-top pt-4">
                        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-md-between mb-4">
                            <div>
                                <h3 class="h4 text-primary mb-1">
                                    <i class="fas fa-star me-2"></i>{{ __('app.products.reviews.title') }}
                                </h3>
                                <p class="text-muted mb-0">
                                    {{ trans_choice('app.products.reviews.count', $viewData['reviewsCount'], ['count' => $viewData['reviewsCount']]) }}
                                </p>
                            </div>
                            <div class="text-warning mt-3 mt-md-0">
                                @if ($viewData['averageRating'])
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= round($viewData['averageRating']))
                                            <i class="fas fa-star"></i>
                                        @else
                                               <i class="far fa-star text-muted"></i>
                                        @endif
                                    @endfor
                                    <span class="ms-2 text-dark">
                                        {{ $viewData['averageRating'] }} {{ __('app.common.of') ?? 'de' }} 5
                                    </span>
                                @else
                                    <span class="text-muted">{{ __('app.products.reviews.no_reviews') }}</span>
                                @endif
                            </div>
                        </div>

                        @if ($viewData['reviewsCount'] === 0)
                            <p class="text-muted">{{ __('app.products.reviews.no_reviews') }}</p>
                        @else
                            <div class="row g-3 mb-4">
                                @foreach ($viewData['reviews'] as $review)
                                    <div class="col-12">
                                        <div class="card shadow-sm">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <strong>{{ $review->getUser()?->getName() }}</strong>
                                                        <small class="text-muted ms-2">
                                                            {{ \Carbon\Carbon::parse($review->getCreatedAt())->format('d/m/Y H:i') }}
                                                        </small>
                                                    </div>
                                                    <div class="text-warning">
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            @if ($i <= $review->getQualification())
                                                                <i class="fas fa-star"></i>
                                                            @else
                                                                <i class="far fa-star text-muted"></i>
                                                            @endif
                                                        @endfor
                                                    </div>
                                                </div>
                                                <p class="mt-3 mb-0">{{ $review->getDescription() }}</p>

                                                @auth
                                                    @if (auth()->id() === $review->getUserId())
                                                        <form action="{{ route('review.destroy', $review->getId()) }}" method="POST" class="mt-3">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('{{ __('app.products.actions.confirm_delete') }}')">
                                                                <i class="fas fa-trash me-1"></i>{{ __('app.products.actions.delete_review') }}
                                                            </button>
                                                        </form>
                                                    @endif
                                                @endauth
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        @auth
                            @if ($viewData['canReview'])
                                <div class="card bg-light">
                                    <div class="card-body">
                                        <h4 class="h5 text-primary mb-3">
                                            <i class="fas fa-pen-fancy me-2"></i>{{ __('app.products.reviews.write_title') }}
                                        </h4>
                                        <form method="POST" action="{{ route('review.store') }}">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $viewData['product']->getId() }}">

                                            <div class="mb-3">
                                                <label for="qualification" class="form-label">{{ __('app.products.reviews.rating_label') }}</label>
                                                <select name="qualification" id="qualification" class="form-select @error('qualification') is-invalid @enderror" required>
                                                    <option value="">{{ __('app.common.select') }}</option>
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <option value="{{ $i }}" {{ old('qualification') == $i ? 'selected' : '' }}>{{ $i }} / 5</option>
                                                    @endfor
                                                </select>
                                                @error('qualification')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="description" class="form-label">{{ __('app.products.reviews.description_label') }}</label>
                                                <textarea name="description" id="description" rows="4" class="form-control @error('description') is-invalid @enderror" required>{{ old('description') }}</textarea>
                                                @error('description')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="d-flex justify-content-end">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fas fa-paper-plane me-2"></i>{{ __('app.products.reviews.submit') }}
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @elseif (! $viewData['hasPurchased'])
                                <p class="text-muted">{{ __('app.products.reviews.messages.purchase_required') }}</p>
                            @elseif ($viewData['userReview'])
                                <p class="text-muted">{{ __('app.products.reviews.messages.already_reviewed') }}</p>
                            @endif
                        @else
                            <p class="text-muted">
                                <i class="fas fa-user-lock me-2"></i>{{ __('app.products.reviews.login_message') }}
                            </p>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
