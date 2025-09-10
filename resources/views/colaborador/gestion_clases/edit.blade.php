@extends('colaborador.gestion_clases.layout')

@section('content')
<div class="container">
    <h2 class="mb-4">Editar Información del Horario</h2>

    <!-- Card principal -->
    <div class="card shadow-lg rounded-3 border-0">
        <div class="card-header bg-gradient-primary text-white d-flex justify-content-between align-items-center">
            <span><i class="bi bi-calendar-event"></i> Editar Horario: {{ $horario->dia }} - {{ $horario->fecha }}</span>
            <a href="{{ route('horarios.index') }}" class="btn btn-secondary btn-sm">
                <i class="bi bi-arrow-left"></i> Volver
            </a>
        </div>

        <div class="card-body">
            <form action="{{ route('horarios.update', $horario->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Información del horario -->
                <h5 class="text-primary mb-3">Información del Horario</h5>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="dia" class="form-label">Día *</label>
                        <label for="dia" class="form-label">Día *</label>
<select name="dia" id="dia" class="form-control" required>
    <option value="">Seleccione un día</option>
    @foreach($dias as $dia)
        <option value="{{ $dia }}" {{ strtolower($horario->dia) == strtolower($dia) ? 'selected' : '' }}>
            {{ ucfirst($dia) }}
        </option>
    @endforeach
</select>

                    </div>
                    <div class="col-md-6">
                        <label for="fecha" class="form-label">Fecha *</label>
                        <input type="date" class="form-control" id="fecha" name="fecha" value="{{ $horario->fecha }}" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="hora_inicio" class="form-label">Hora Inicio *</label>
                        <input type="time" class="form-control" id="hora_inicio" name="hora_inicio" value="{{ $horario->hora_inicio }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="hora_fin" class="form-label">Hora Fin *</label>
                        <input type="time" class="form-control" id="hora_fin" name="hora_fin" value="{{ $horario->hora_fin }}" required>
                    </div>
                </div>

                <!-- Información adicional -->
                <h5 class="text-primary mb-3">Información Instructor</h5>
                <div class="row mb-3">
                    <div class="mb-3">
    <label for="instructor_id" class="form-label">Instructor</label>
    <select name="instructor_id" id="instructor_id" class="form-control">
        <option value="">Seleccione un instructor</option>
        @foreach($instructores as $instructor)
            <option value="{{ $instructor->id }}" 
                {{ $horario->instructor_id == $instructor->id ? 'selected' : '' }}>
                {{ $instructor->name }}
            </option>
        @endforeach
    </select>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
    <label for="grupo_id" class="form-label">Grupo</label>
    <select name="grupo_id" id="grupo_id" class="form-control">
        <option value="">Seleccione un grupo</option>
        @foreach($grupos as $grupo)
            <option value="{{ $grupo->id }}" 
                {{ $horario->grupo_id == $grupo->id ? 'selected' : '' }}>
                {{ $grupo->nombre }}
            </option>
        @endforeach
    </select>
                    </div>
                </div>

                <!-- Botones -->
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success me-2">
                        <i class="bi bi-check-circle"></i> Actualizar
                    </button>
                    <a href="{{ route('horarios.index') }}" class="btn btn-secondary">
                        <i class="bi bi-x-circle"></i> Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
