@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h1>{{ __('messages.edit_veterinary_appointment') }}</h1>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('veterinary-appointment.update', $viewData['appointment']->getId()) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group mb-3">
                        <label for="date_time">{{ __('messages.date_time') }} *</label>
                        <input type="datetime-local" class="form-control" id="date_time" name="date_time" 
                               value="{{ old('date_time', $viewData['appointment']->getDateTime()) }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="service_type">{{ __('messages.service_type') }} *</label>
                        <select class="form-control" id="service_type" name="service_type" required>
                            <option value="">{{ __('messages.select_service_type') }}</option>
                            <option value="consulta" {{ (old('service_type', $viewData['appointment']->getServiceType()) === 'consulta') ? 'selected' : '' }}>
                                {{ __('messages.consultation') }}
                            </option>
                            <option value="vacunacion" {{ (old('service_type', $viewData['appointment']->getServiceType()) === 'vacunacion') ? 'selected' : '' }}>
                                {{ __('messages.vaccination') }}
                            </option>
                            <option value="cirugia" {{ (old('service_type', $viewData['appointment']->getServiceType()) === 'cirugia') ? 'selected' : '' }}>
                                {{ __('messages.surgery') }}
                            </option>
                            <option value="emergencia" {{ (old('service_type', $viewData['appointment']->getServiceType()) === 'emergencia') ? 'selected' : '' }}>
                                {{ __('messages.emergency') }}
                            </option>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="status">{{ __('messages.status') }} *</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="programada" {{ (old('status', $viewData['appointment']->getStatus()) === 'programada') ? 'selected' : '' }}>
                                {{ __('messages.scheduled') }}
                            </option>
                            <option value="confirmada" {{ (old('status', $viewData['appointment']->getStatus()) === 'confirmada') ? 'selected' : '' }}>
                                {{ __('messages.confirmed') }}
                            </option>
                            <option value="completada" {{ (old('status', $viewData['appointment']->getStatus()) === 'completada') ? 'selected' : '' }}>
                                {{ __('messages.completed') }}
                            </option>
                            <option value="cancelada" {{ (old('status', $viewData['appointment']->getStatus()) === 'cancelada') ? 'selected' : '' }}>
                                {{ __('messages.cancelled') }}
                            </option>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="notes">{{ __('messages.notes') }}</label>
                        <textarea class="form-control" id="notes" name="notes" rows="4">{{ old('notes', $viewData['appointment']->getNotes()) }}</textarea>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">{{ __('messages.update_appointment') }}</button>
                        <a href="{{ route('veterinary-appointment.show', $viewData['appointment']->getId()) }}" class="btn btn-secondary">{{ __('messages.cancel') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection