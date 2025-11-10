@extends('layouts.admin')

@section('title', $viewData['title'])

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="text-center mb-5">
                    <h1 class="display-4 text-primary">{{ __('appointments.appointment_details') }}</h1>
                </div>

                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">{{ __('appointments.appointment') }} #{{ $viewData['appointment']->getId() }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p><strong>{{ __('appointments.user') }}:</strong> {{ $viewData['appointment']->getUser()->getName() }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>{{ __('appointments.email') }}:</strong> {{ $viewData['appointment']->getUser()->getEmail() }}</p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p><strong>{{ __('appointments.pet_name') }}:</strong> {{ $viewData['appointment']->getPetName() }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>{{ __('appointments.pet_type') }}:</strong> {{ $viewData['appointment']->getPetType() }}</p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p><strong>{{ __('appointments.date') }}:</strong> {{ $viewData['appointment']->getDate() }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>{{ __('appointments.time') }}:</strong> {{ $viewData['appointment']->getTime() }}</p>
                            </div>
                        </div>

                        <div class="mb-3">
                            <p><strong>{{ __('appointments.status') }}:</strong>
                                <span class="badge bg-{{ $viewData['appointment']->getStatus() === 'pending' ? 'warning' : ($viewData['appointment']->getStatus() === 'confirmed' ? 'success' : ($viewData['appointment']->getStatus() === 'completed' ? 'info' : 'danger')) }}">
                                    {{ __('appointments.status_' . $viewData['appointment']->getStatus()) }}
                                </span>
                            </p>
                        </div>

                        <div class="mb-3">
                            <p><strong>{{ __('appointments.reason') }}:</strong></p>
                            <p class="text-muted">{{ $viewData['appointment']->getReason() }}</p>
                        </div>

                        <div class="mb-3">
                            <p class="text-muted"><small>{{ __('appointments.created_at') }}: {{ $viewData['appointment']->getCreatedAt() }}</small></p>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent">
                        <div class="d-grid gap-2 d-md-flex justify-content-md-between">
                            <a href="{{ route('admin.appointment.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i>{{ __('appointments.back') }}
                            </a>
                            <div>
                                <a href="{{ route('admin.appointment.edit', ['id' => $viewData['appointment']->getId()]) }}" class="btn btn-warning me-2">
                                    <i class="fas fa-edit me-2"></i>{{ __('appointments.edit') }}
                                </a>
                                <form action="{{ route('admin.appointment.destroy', ['id' => $viewData['appointment']->getId()]) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('{{ __('appointments.confirm_delete') }}')">
                                        <i class="fas fa-trash me-2"></i>{{ __('appointments.delete') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
