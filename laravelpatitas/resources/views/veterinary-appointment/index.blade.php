@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Citas Veterinarias</h1>
                
                <div class="mb-3">
                    <a href="{{ route('veterinary-appointment.create') }}" class="btn btn-primary">
                        Solicitar nueva cita
                    </a>
                </div>

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Fecha y Hora</th>
                                <th>Tipo de Servicio</th>
                                <th>Estado</th>
                                <th>Usuario</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($viewData['appointments'] as $appointment)
                                <tr>
                                    <td>{{ $appointment->getId() }}</td>
                                    <td>{{ $appointment->getDateTime() }}</td>
                                    <td>{{ $appointment->getServiceType() }}</td>
                                    <td>
                                        <span class="badge badge-{{ $appointment->getStatus() === 'completada' ? 'success' : ($appointment->getStatus() === 'cancelada' ? 'danger' : ($appointment->getStatus() === 'confirmada' ? 'info' : 'warning')) }}">
                                            {{ ucfirst($appointment->getStatus()) }}
                                        </span>
                                    </td>
                                    <td>{{ $appointment->getUser()->getName() }}</td>
                                    <td>
                                        <a href="{{ route('veterinary-appointment.show', $appointment->getId()) }}" class="btn btn-sm btn-info">
                                            Ver
                                        </a>
                                        <a href="{{ route('veterinary-appointment.edit', $appointment->getId()) }}" class="btn btn-sm btn-warning">
                                            Editar
                                        </a>
                                        <form action="{{ route('veterinary-appointment.destroy', $appointment->getId()) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro que deseas eliminar esta cita?')">
                                                Eliminar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection