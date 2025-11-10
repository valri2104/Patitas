@extends('layouts.admin')

@section('title', __('admin.users.edit.title', ['name' => $viewData['user']->getName()]))
@section('subtitle', __('admin.users.edit.subtitle'))

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2>{{ __('admin.users.edit.title', ['name' => $viewData['user']->getName()]) }}</h2>
                <p class="text-muted mb-0">{{ __('admin.users.edit.subtitle') }}</p>
            </div>
            <a href="{{ route('admin.user.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>{{ __('admin.users.actions.back_to_list') }}
            </a>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">{{ __('admin.users.edit.form_title') }}</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.user.update', $viewData['user']->getId()) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        {{-- Name --}}
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">
                                {{ __('admin.users.form.name') }} <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" placeholder="{{ __('admin.users.form.name_placeholder') }}"
                                value="{{ old('name', $viewData['user']->getName()) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">
                                {{ __('admin.users.form.email') }} <span class="text-danger">*</span>
                            </label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                name="email" placeholder="{{ __('admin.users.form.email_placeholder') }}"
                                value="{{ old('email', $viewData['user']->getEmail()) }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        {{-- Phone --}}
                        <div class="col-md-6 mb-3">
                            <label for="phone" class="form-label">
                                {{ __('admin.users.form.phone') }}
                            </label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone"
                                name="phone" placeholder="{{ __('admin.users.form.phone_placeholder') }}"
                                value="{{ old('phone', $viewData['user']->getPhone()) }}">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Role --}}
                        <div class="col-md-6 mb-3">
                            <label for="role" class="form-label">
                                {{ __('admin.users.form.role') }} <span class="text-danger">*</span>
                            </label>
                            <select class="form-select @error('role') is-invalid @enderror" id="role" name="role"
                                required>
                                <option value="" disabled>{{ __('admin.users.form.role_placeholder') }}</option>
                                @foreach ($viewData['roles'] as $role)
                                    <option value="{{ $role->value }}"
                                        {{ old('role', $viewData['user']->getRole()->value) == $role->value ? 'selected' : '' }}>
                                        {{ __('admin.users.roles.' . $role->value) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('role')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Address --}}
                    <div class="mb-3">
                        <label for="address" class="form-label">
                            {{ __('admin.users.form.address') }}
                        </label>
                        <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="3"
                            placeholder="{{ __('admin.users.form.address_placeholder') }}">{{ old('address', $viewData['user']->getAddress()) }}</textarea>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Buttons --}}
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.user.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times me-2"></i>{{ __('admin.common.cancel') }}
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>{{ __('admin.users.actions.update') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
