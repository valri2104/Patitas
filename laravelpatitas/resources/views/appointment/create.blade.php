@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="text-center mb-5">
                    <h1 class="display-4 text-primary">{{ __('appointments.create_appointment') }}</h1>
                    <p class="lead text-muted">{{ __('appointments.schedule_visit') }}</p>
                </div>

                <div class="card shadow-sm">
                    <div class="card-body">
                        <form action="{{ route('appointment.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="date" class="form-label">{{ __('appointments.date') }} *</label>
                                <input type="date" class="form-control @error('date') is-invalid @enderror"
                                    id="date" name="date" value="{{ old('date') }}" min="{{ date('Y-m-d') }}" required>
                                @error('date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="time" class="form-label">{{ __('appointments.time') }} *</label>
                                <input type="time" class="form-control @error('time') is-invalid @enderror"
                                    id="time" name="time" value="{{ old('time') }}" required>
                                @error('time')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="pet_name" class="form-label">{{ __('appointments.pet_name') }} *</label>
                                <input type="text" class="form-control @error('pet_name') is-invalid @enderror"
                                    id="pet_name" name="pet_name" value="{{ old('pet_name') }}" required>
                                @error('pet_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="pet_type" class="form-label">{{ __('appointments.pet_type') }} *</label>
                                <select class="form-select @error('pet_type') is-invalid @enderror"
                                    id="pet_type" name="pet_type" required>
                                    <option value="">{{ __('appointments.select_pet_type') }}</option>
                                    <option value="Dog" {{ old('pet_type') === 'Dog' ? 'selected' : '' }}>{{ __('appointments.pet_types.dog') }}</option>
                                    <option value="Cat" {{ old('pet_type') === 'Cat' ? 'selected' : '' }}>{{ __('appointments.pet_types.cat') }}</option>
                                    <option value="Bird" {{ old('pet_type') === 'Bird' ? 'selected' : '' }}>{{ __('appointments.pet_types.bird') }}</option>
                                    <option value="Rabbit" {{ old('pet_type') === 'Rabbit' ? 'selected' : '' }}>{{ __('appointments.pet_types.rabbit') }}</option>
                                    <option value="Hamster" {{ old('pet_type') === 'Hamster' ? 'selected' : '' }}>{{ __('appointments.pet_types.hamster') }}</option>
                                    <option value="Other" {{ old('pet_type') === 'Other' ? 'selected' : '' }}>{{ __('appointments.pet_types.other') }}</option>
                                </select>
                                @error('pet_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="reason" class="form-label">{{ __('appointments.reason') }} *</label>
                                <textarea class="form-control @error('reason') is-invalid @enderror"
                                    id="reason" name="reason" rows="4" required>{{ old('reason') }}</textarea>
                                @error('reason')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="{{ route('appointment.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-times me-2"></i>{{ __('appointments.cancel') }}
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-calendar-check me-2"></i>{{ __('appointments.create') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
