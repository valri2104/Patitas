@extends('layouts.admin')

@section('title', $viewData['title'])

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="text-center mb-5">
                    <h1 class="display-4 text-primary">{{ __('appointments.edit_appointment') }}</h1>
                </div>

                <div class="card shadow-sm">
                    <div class="card-body">
                        <form action="{{ route('admin.appointment.update', ['id' => $viewData['appointment']->getId()]) }}"
                            method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="date" class="form-label">{{ __('appointments.date') }} *</label>
                                <input type="date" class="form-control @error('date') is-invalid @enderror"
                                    id="date" name="date"
                                    value="{{ old('date', $viewData['appointment']->getDate()) }}" required>
                                @error('date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="time" class="form-label">{{ __('appointments.time') }} *</label>
                                <input type="time" class="form-control @error('time') is-invalid @enderror"
                                    id="time" name="time"
                                    value="{{ old('time', $viewData['appointment']->getTime()) }}" required>
                                @error('time')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="pet_name" class="form-label">{{ __('appointments.pet_name') }} *</label>
                                <input type="text" class="form-control @error('pet_name') is-invalid @enderror"
                                    id="pet_name" name="pet_name"
                                    value="{{ old('pet_name', $viewData['appointment']->getPetName()) }}" required>
                                @error('pet_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="pet_type" class="form-label">{{ __('appointments.pet_type') }} *</label>
                                <select class="form-select @error('pet_type') is-invalid @enderror" id="pet_type"
                                    name="pet_type" required>
                                    <option value="">{{ __('appointments.select_pet_type') }}</option>
                                    <option value="Dog"
                                        {{ old('pet_type', $viewData['appointment']->getPetType()) === 'Dog' ? 'selected' : '' }}>
                                        {{ __('appointments.pet_types.dog') }}</option>
                                    <option value="Cat"
                                        {{ old('pet_type', $viewData['appointment']->getPetType()) === 'Cat' ? 'selected' : '' }}>
                                        {{ __('appointments.pet_types.cat') }}</option>
                                    <option value="Bird"
                                        {{ old('pet_type', $viewData['appointment']->getPetType()) === 'Bird' ? 'selected' : '' }}>
                                        {{ __('appointments.pet_types.bird') }}</option>
                                    <option value="Rabbit"
                                        {{ old('pet_type', $viewData['appointment']->getPetType()) === 'Rabbit' ? 'selected' : '' }}>
                                        {{ __('appointments.pet_types.rabbit') }}</option>
                                    <option value="Hamster"
                                        {{ old('pet_type', $viewData['appointment']->getPetType()) === 'Hamster' ? 'selected' : '' }}>
                                        {{ __('appointments.pet_types.hamster') }}</option>
                                    <option value="Other"
                                        {{ old('pet_type', $viewData['appointment']->getPetType()) === 'Other' ? 'selected' : '' }}>
                                        {{ __('appointments.pet_types.other') }}</option>
                                </select>
                                @error('pet_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="reason" class="form-label">{{ __('appointments.reason') }} *</label>
                                <textarea class="form-control @error('reason') is-invalid @enderror" id="reason" name="reason" rows="4"
                                    required>{{ old('reason', $viewData['appointment']->getReason()) }}</textarea>
                                @error('reason')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="status" class="form-label">{{ __('appointments.status') }} *</label>
                                <select class="form-select @error('status') is-invalid @enderror" id="status"
                                    name="status" required>
                                    <option value="pending"
                                        {{ old('status', $viewData['appointment']->getStatus()) === 'pending' ? 'selected' : '' }}>
                                        {{ __('appointments.status_pending') }}</option>
                                    <option value="confirmed"
                                        {{ old('status', $viewData['appointment']->getStatus()) === 'confirmed' ? 'selected' : '' }}>
                                        {{ __('appointments.status_confirmed') }}</option>
                                    <option value="completed"
                                        {{ old('status', $viewData['appointment']->getStatus()) === 'completed' ? 'selected' : '' }}>
                                        {{ __('appointments.status_completed') }}</option>
                                    <option value="cancelled"
                                        {{ old('status', $viewData['appointment']->getStatus()) === 'cancelled' ? 'selected' : '' }}>
                                        {{ __('appointments.status_cancelled') }}</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="{{ route('admin.appointment.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-times me-2"></i>{{ __('appointments.cancel') }}
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-2"></i>{{ __('appointments.save') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
