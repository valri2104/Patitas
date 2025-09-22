@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h1>Solicitar nueva cita veterinaria</h1>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('veterinary-appointment.store') }}" method="POST">
                    @csrf
                    
                    <div class="form-group mb-3">
                        <label for="date_time">Fecha y hora *</label>
                        <input type="datetime-local" class="form-control" id="date_time" name="date_time" 
                               value="{{ old('date_time') }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="service_type">Tipo de servicio *</label>
                        <select class="form-control" id="service_type" name="service_type" required>
                            <option value="">Seleccione un tipo de servicio</option>
                            <option value="consulta" {{ old('service_type') === 'consulta' ? 'selected' : '' }}>
                                Consulta
                            </option>
                            <option value="vacunacion" {{ old('service_type') === 'vacunacion' ? 'selected' : '' }}>
                                Vacunación
                            </option>
                            <option value="cirugia" {{ old('service_type') === 'cirugia' ? 'selected' : '' }}>
                                Cirugía
                            </option>
                            <option value="emergencia" {{ old('service_type') === 'emergencia' ? 'selected' : '' }}>
                                Emergencia
                            </option>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="status">Estado *</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="programada" {{ old('status') === 'programada' ? 'selected' : '' }}>
                                Programada
                            </option>
                            <option value="confirmada" {{ old('status') === 'confirmada' ? 'selected' : '' }}>
                                Confirmada
                            </option>
                            <option value="completada" {{ old('status') === 'completada' ? 'selected' : '' }}>
                                Completada
                            </option>
                            <option value="cancelada" {{ old('status') === 'cancelada' ? 'selected' : '' }}>
                                Cancelada
                            </option>
                        </select>
                    </div>

                    @if(isset($viewData['users']) && $viewData['users'])
                        <div class="form-group mb-3">
                            <label for="user_id">Usuario *</label>
                            <select class="form-control" id="user_id" name="user_id" required>
                                <option value="">Seleccione un usuario</option>
                                @foreach($viewData['users'] as $user)
                                    <option value="{{ $user->getId() }}">{{ $user->getName() }} ({{ $user->getEmail() }})</option>
                                @endforeach
                            </select>
                        </div>
                    @endif

                    <div class="form-group mb-3">
                        <label for="notes">Notas</label>
                        <textarea class="form-control" id="notes" name="notes" rows="4">{{ old('notes') }}</textarea>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Crear cita</button>
                        <a href="{{ route('veterinary-appointment.index') }}" class="btn btn-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection