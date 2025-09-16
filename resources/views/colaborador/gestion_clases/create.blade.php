@extends('colaborador.gestion_clases.layout')

@section('title', 'Gestión de Clases - Crear Horario')

@section('content')
    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3a0ca3;
            --success-color: #4cc9f0;
            --light-bg: #f8f9fa;
            --card-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
            --hover-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .app-container {
            max-width: 1000px;
            margin: 0 auto;
        }

        .card-modern {
            border: none;
            border-radius: 16px;
            box-shadow: var(--card-shadow);
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .card-modern:hover {
            box-shadow: var(--hover-shadow);
        }

        .card-header-modern {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border-bottom: none;
            padding: 1.5rem;
        }

        .form-control,
        .form-select {
            border-radius: 10px;
            padding: 0.75rem 1rem;
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(67, 97, 238, 0.15);
        }

        .btn-modern {
            border-radius: 50px;
            padding: 0.75rem 2rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border: none;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(67, 97, 238, 0.4);
        }

        .btn-secondary {
            background: #6c757d;
            border: none;
        }

        .btn-secondary:hover {
            background: #5a6268;
            transform: translateY(-2px);
        }

        .alert-modern {
            border-radius: 12px;
            border: none;
            box-shadow: var(--card-shadow);
        }

        .time-inputs {
            display: flex;
            gap: 1rem;
        }

        .time-inputs .form-group {
            flex: 1;
        }

        @media (max-width: 768px) {
            .time-inputs {
                flex-direction: column;
                gap: 0.5rem;
            }
        }
    </style>

    <div class="container py-4">
        <div class="app-container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="mb-0">Crear Horario de Clases</h2>
                <a href="{{ route('colaborador.dashboard') }}" class="btn btn-secondary btn-modern">
                    <i class="bi bi-arrow-left me-1"></i> Volver
                </a>
            </div>

            {{-- Mostrar errores de validación --}}
            @if ($errors->any())
                <div class="alert alert-danger alert-modern mb-4">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        <h6 class="mb-0">Por favor, corrige los siguientes errores:</h6>
                    </div>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Formulario para crear un horario --}}
            <div class="card card-modern">
                <div class="card-header card-header-modern">
                    <h5 class="mb-0"><i class="bi bi-calendar-plus me-2"></i> Información del Horario</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('horarios.store') }}" method="POST" id="horarioForm">
                        @csrf

                        <div class="row">
                            {{-- Seleccionar Instructor --}}
                            <div class="col-md-6 mb-3">
                                <label for="instructor_id" class="form-label">Instructor <span
                                        class="text-danger">*</span></label>
                                <select name="instructor_id" id="instructor_id" class="form-select" required>
                                    <option value="" disabled selected>-- Selecciona un instructor --</option>
                                    @foreach ($instructores as $instructor)
                                        <option value="{{ $instructor->id }}" {{ old('instructor_id') == $instructor->id ? 'selected' : '' }}>
                                            {{ $instructor->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Seleccionar Grupo --}}
                            <div class="col-md-6 mb-3">
                                <label for="grupo_id" class="form-label">Grupo <span class="text-danger">*</span></label>
                                <select name="grupo_id" id="grupo_id" class="form-select" required>
                                    <option value="" disabled selected>-- Selecciona un grupo --</option>
                                    @foreach ($grupos as $grupo)
                                        <option value="{{ $grupo->id }}" {{ old('grupo_id') == $grupo->id ? 'selected' : '' }}>
                                            {{ $grupo->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            {{-- Día de la semana --}}
                            <div class="col-md-6 mb-3">
                                <label for="dia" class="form-label">Día de la semana <span
                                        class="text-danger">*</span></label>
                                <select name="dia" id="dia" class="form-select" required>
                                    <option value="" disabled selected>-- Selecciona un día --</option>
                                    <option value="Lunes" {{ old('dia') == 'Lunes' ? 'selected' : '' }}>Lunes</option>
                                    <option value="Martes" {{ old('dia') == 'Martes' ? 'selected' : '' }}>Martes</option>
                                    <option value="Miércoles" {{ old('dia') == 'Miércoles' ? 'selected' : '' }}>Miércoles
                                    </option>
                                    <option value="Jueves" {{ old('dia') == 'Jueves' ? 'selected' : '' }}>Jueves</option>
                                    <option value="Viernes" {{ old('dia') == 'Viernes' ? 'selected' : '' }}>Viernes</option>
                                    <option value="Sábado" {{ old('dia') == 'Sábado' ? 'selected' : '' }}>Sábado</option>
                                    <option value="Domingo" {{ old('dia') == 'Domingo' ? 'selected' : '' }}>Domingo</option>
                                </select>
                            </div>

                            {{-- Fecha específica --}}
                            <div class="col-md-6 mb-3">
                                <label for="fecha" class="form-label">Fecha específica <span
                                        class="text-danger">*</span></label>
                                <input type="date" name="fecha" id="fecha" class="form-control" value="{{ old('fecha') }}"
                                    min="{{ date('Y-m-d') }}" required>
                                <div class="form-text">Selecciona la fecha para este horario</div>
                            </div>
                        </div>

                        <div class="row">
                            {{-- Horario --}}
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Horario <span class="text-danger">*</span></label>
                                <div class="time-inputs">
                                    <div class="form-group">
                                        <label for="hora_inicio" class="form-label">Hora de inicio</label>
                                        <input type="time" name="hora_inicio" id="hora_inicio" class="form-control"
                                            value="{{ old('hora_inicio') }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="hora_fin" class="form-label">Hora de fin</label>
                                        <input type="time" name="hora_fin" id="hora_fin" class="form-control"
                                            value="{{ old('hora_fin') }}" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <button type="reset" class="btn btn-secondary btn-modern">Limpiar</button>
                            <button type="submit" class="btn btn-primary btn-modern">
                                <i class="bi bi-check-circle me-1"></i> Guardar Horario
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Validación de fechas y horas
            const form = document.getElementById('horarioForm');
            const horaInicio = document.getElementById('hora_inicio');
            const horaFin = document.getElementById('hora_fin');

            form.addEventListener('submit', function (e) {
                // Validar que la hora de fin sea posterior a la hora de inicio
                if (horaInicio.value && horaFin.value && horaInicio.value >= horaFin.value) {
                    e.preventDefault();
                    alert('La hora de fin debe ser posterior a la hora de inicio');
                    horaFin.focus();
                }

                // Validar que la fecha no sea anterior a hoy
                const fechaInput = document.getElementById('fecha');
                const today = new Date().toISOString().split('T')[0];
                if (fechaInput.value < today) {
                    e.preventDefault();
                    alert('La fecha no puede ser anterior al día de hoy');
                    fechaInput.focus();
                }
            });

            // Establecer valores por defecto para horas si están vacíos
            if (!horaInicio.value) {
                horaInicio.value = '08:00';
            }
            if (!horaFin.value) {
                horaFin.value = '09:00';
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="app.js"></script>
@endsection