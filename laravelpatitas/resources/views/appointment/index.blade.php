@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="text-center mb-5">
                    <h1 class="display-4 text-primary">{{ __('appointments.my_appointments') }}</h1>
                    <p class="lead text-muted">{{ __('appointments.manage_your_appointments') }}</p>
                </div>

                <div class="mb-4">
                    <a href="{{ route('appointment.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>{{ __('appointments.create_appointment') }}
                    </a>
                </div>

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if ($viewData['appointments']->isEmpty())
                    <div class="alert alert-info text-center">
                        <p class="mb-0">{{ __('appointments.no_appointments') }}</p>
                    </div>
                @else
                    <div class="row">
                        @foreach ($viewData['appointments'] as $appointment)
                            <div class="col-md-6 col-lg-4 mb-4">
                                <div class="card h-100 shadow-sm">
                                    <div class="card-header bg-primary text-white">
                                        <h5 class="mb-0">{{ $appointment->getPetName() }}</h5>
                                    </div>
                                    <div class="card-body">
                                        <p><strong>{{ __('appointments.date') }}:</strong> {{ $appointment->getDate() }}</p>
                                        <p><strong>{{ __('appointments.time') }}:</strong> {{ $appointment->getTime() }}
                                        </p>
                                        <p><strong>{{ __('appointments.pet_type') }}:</strong>
                                            {{ $appointment->getPetType() }}</p>
                                        <p><strong>{{ __('appointments.status') }}:</strong>
                                            <span
                                                class="badge bg-{{ $appointment->getStatus() === 'pending' ? 'warning' : ($appointment->getStatus() === 'confirmed' ? 'success' : ($appointment->getStatus() === 'completed' ? 'info' : 'danger')) }}">
                                                {{ __('appointments.status_' . $appointment->getStatus()) }}
                                            </span>
                                        </p>
                                        <p><strong>{{ __('appointments.reason') }}:</strong>
                                            {{ \Illuminate\Support\Str::limit($appointment->getReason(), 100) }}</p>
                                    </div>
                                    <div class="card-footer bg-transparent">
                                        <div class="d-flex justify-content-between">
                                            <a href="{{ route('appointment.show', ['id' => $appointment->getId()]) }}"
                                                class="btn btn-sm btn-info">
                                                <i class="fas fa-eye me-1"></i>{{ __('appointments.view') }}
                                            </a>
                                            @if ($appointment->getStatus() === 'pending')
                                                <form
                                                    action="{{ route('appointment.destroy', ['id' => $appointment->getId()]) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                        onclick="return confirm('{{ __('appointments.confirm_delete') }}')">
                                                        <i class="fas fa-trash me-1"></i>{{ __('appointments.cancel') }}
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
