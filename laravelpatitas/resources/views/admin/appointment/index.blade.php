@extends('layouts.admin')

@section('title', $viewData['title'])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="text-center mb-5">
                    <h1 class="display-4 text-primary">{{ __('appointments.admin_appointments') }}</h1>
                    <p class="lead text-muted">{{ __('appointments.manage_all_appointments') }}</p>
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
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th>ID</th>
                                            <th>{{ __('appointments.user') }}</th>
                                            <th>{{ __('appointments.pet_name') }}</th>
                                            <th>{{ __('appointments.pet_type') }}</th>
                                            <th>{{ __('appointments.date') }}</th>
                                            <th>{{ __('appointments.time') }}</th>
                                            <th>{{ __('appointments.status') }}</th>
                                            <th>{{ __('appointments.actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($viewData['appointments'] as $appointment)
                                            <tr>
                                                <td>{{ $appointment->getId() }}</td>
                                                <td>{{ $appointment->getUser()->getName() }}</td>
                                                <td>{{ $appointment->getPetName() }}</td>
                                                <td>{{ $appointment->getPetType() }}</td>
                                                <td>{{ $appointment->getDate() }}</td>
                                                <td>{{ $appointment->getTime() }}</td>
                                                <td>
                                                    <span class="badge bg-{{ $appointment->getStatus() === 'pending' ? 'warning' : ($appointment->getStatus() === 'confirmed' ? 'success' : ($appointment->getStatus() === 'completed' ? 'info' : 'danger')) }}">
                                                        {{ __('appointments.status_' . $appointment->getStatus()) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <a href="{{ route('admin.appointment.show', ['id' => $appointment->getId()]) }}" class="btn btn-sm btn-info" title="{{ __('appointments.view') }}">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="{{ route('admin.appointment.edit', ['id' => $appointment->getId()]) }}" class="btn btn-sm btn-warning" title="{{ __('appointments.edit') }}">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('admin.appointment.destroy', ['id' => $appointment->getId()]) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('{{ __('appointments.confirm_delete') }}')" title="{{ __('appointments.delete') }}">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
