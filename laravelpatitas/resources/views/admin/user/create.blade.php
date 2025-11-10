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
                            <label for="name" class="form-label">
                                {{ __('admin.users.form.name') }} <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">
                                {{ __('admin.users.form.email') }} <span class="text-danger">*</span>
                            </label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="phone" class="form-label">{{ __('admin.users.form.phone') }}</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone"
                                name="phone" value="{{ old('phone') }}">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="address" class="form-label">{{ __('admin.users.form.address') }}</label>
                            <input type="text" class="form-control @error('address') is-invalid @enderror" id="address"
                                name="address" value="{{ old('address') }}">
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="password" class="form-label">
                                {{ __('admin.users.form.password') }} <span class="text-danger">*</span>
                            </label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="password" name="password" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="password_confirmation" class="form-label">
                                {{ __('admin.users.form.password_confirm') }} <span class="text-danger">*</span>
                            </label>
                            <input type="password" class="form-control" id="password_confirmation"
                                name="password_confirmation" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="role" class="form-label">
                            {{ __('admin.users.form.role') }} <span class="text-danger">*</span>
                        </label>
                        <select class="form-select @error('role') is-invalid @enderror" id="role" name="role"
                            required>
                            <option value="">{{ __('admin.users.form.role_placeholder') }}</option>
                            @foreach ($viewData['role'] as $role)
                                <option value="{{ $role->value }}" {{ old('role') == $role->value ? 'selected' : '' }}>
                                    {{ __('admin.users.roles.' . $role->value) }}
                                </option>
                            @endforeach
                        </select>
                        @error('role')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.user.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times me-2"></i>{{ __('admin.common.cancel') }}
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>{{ __('admin.users.actions.create') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
