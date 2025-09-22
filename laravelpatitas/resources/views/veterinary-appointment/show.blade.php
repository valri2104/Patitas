@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h1>{{ __('messages.veterinary_appointment_details') }}</h1>

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="card">
                    <div class="card-header">
                        <h5>{{ __('messages.appointment') }} #{{ $viewData['appointment']->getId() }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <strong>{{ __('messages.date_time') }}:</strong><br>
                                {{ $viewData['appointment']->getDateTime() }}
                            </div>
                            <div class="col-md-6">
                                <strong>{{ __('messages.service_type') }}:</strong><br>
                                {{ $viewData['appointment']->getServiceType() }}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <strong>{{ __('messages.status') }}:</strong><br>
                                <span class="badge badge-{{ $viewData['appointment']->getStatus() === 'completada' ? 'success' : ($viewData['appointment']->getStatus() === 'cancelada' ? 'danger' : ($viewData['appointment']->getStatus() === 'confirmada' ? 'info' : 'warning')) }}">
                                    {{ ucfirst($viewData['appointment']->getStatus()) }}
                                </span>
                            </div>
                            <div class="col-md-6">
                                <strong>{{ __('messages.user') }}:</strong><br>
                                {{ $viewData['appointment']->getUser()->getName() }}
                            </div>
                        </div>
                        @if($viewData['appointment']->getNotes())
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <strong>{{ __('messages.notes') }}:</strong><br>
                                    {{ $viewData['appointment']->getNotes() }}
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="mt-3">
                    <a href="{{ route('veterinary-appointment.index') }}" class="btn btn-secondary">
                        {{ __('messages.back_to_list') }}
                    </a>
                    <a href="{{ route('veterinary-appointment.edit', $viewData['appointment']->getId()) }}" class="btn btn-warning">
                        {{ __('messages.edit') }}
                    </a>
                    <form action="{{ route('veterinary-appointment.destroy', $viewData['appointment']->getId()) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('{{ __('messages.confirm_delete') }}')">
                            {{ __('messages.delete') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection