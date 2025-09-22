@extends('layouts.admin')

@section('title', __('admin.users.create.title'))
@section('subtitle', __('admin.users.create.subtitle'))

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2>{{ __('admin.users.create.title') }}</h2>
                <p class="text-muted mb-0">{{ __('admin.users.create.subtitle') }}</p>
            </div>
            <a href="{{ route('admin.user.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>{{ __('admin.users.actions.back_to_list') }}
            </a>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">{{ __('admin.users.create.form_title') }}</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.user.store') }}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">{{ __('admin.users.form.name') }} <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" placeholder="{{ __('admin.users.form.name_placeholder') }}"
                                value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">{{ __('admin.users.form.email') }} <span
                                    class="text-danger">*</span></label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="price" class="form-label">{{ __('admin.products.form.price') }} <span
                                    class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="number" class="form-control @error('price') is-invalid @enderror"
                                    id="price" name="price" step="0.01" min="0"
                                    placeholder="{{ __('admin.products.form.price_placeholder') }}"
                                    value="{{ old('price') }}" required>
                                <span class="input-group-text">{{ __('admin.common.currency') }}</span>
                            </div>
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="stock" class="form-label">{{ __('admin.products.form.stock') }} <span
                                    class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock"
                                name="stock" min="0"
                                placeholder="{{ __('admin.products.form.stock_placeholder') }}"
                                value="{{ old('stock') }}" required>
                            @error('stock')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">{{ __('admin.products.form.description') }} <span
                                class="text-danger">*</span></label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                            rows="4" placeholder="{{ __('admin.products.form.description_placeholder') }}" required>{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="imageUrl" class="form-label">{{ __('admin.products.form.image_url') }}</label>
                        <input type="url" class="form-control @error('imageUrl') is-invalid @enderror" id="imageUrl"
                            name="imageUrl" placeholder="{{ __('admin.products.form.image_url_placeholder') }}"
                            value="{{ old('imageUrl') }}">
                        <div class="form-text">{{ __('admin.products.form.image_url_help') }}</div>
                        @error('imageUrl')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <div class="form-check">
                            <input class="form-check-input @error('customizable') is-invalid @enderror" type="checkbox"
                                id="customizable" name="customizable" value="1"
                                {{ old('customizable') ? 'checked' : '' }}>
                            <label class="form-check-label"
                                for="customizable">{{ __('admin.products.form.customizable') }}</label>
                            <div class="form-text">{{ __('admin.products.form.customizable_help') }}</div>
                            @error('customizable')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.product.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times me-2"></i>{{ __('admin.common.cancel') }}
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>{{ __('admin.products.actions.create') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
