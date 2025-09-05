@extends('colaborador.inscripcion_estudent.layout')

@section('title', 'Editar Estudiante')
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
        max-width: 1200px;
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
    
    .form-control, .form-select {
        border-radius: 10px;
        padding: 0.75rem 1rem;
        border: 1px solid #e2e8f0;
        transition: all 0.3s ease;
    }
    
    .form-control:focus, .form-select:focus {
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
    
    .section-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--primary-color);
        margin-bottom: 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid #e2e8f0;
    }
    
    @media (max-width: 768px) {
        .app-container {
            padding: 0 15px;
        }
    }
</style>

<div class="container py-4">
    <div class="app-container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Editar Información del Estudiante</h2>
            <a href="{{ route('colaborador.inscripcion') }}" class="btn btn-secondary btn-modern">
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

        {{-- Formulario para editar estudiante --}}
        <div class="card card-modern">
            <div class="card-header card-header-modern">
                <h5 class="mb-0"><i class="bi bi-person-check me-2"></i> Editar Estudiante: {{ $estudiante->nombre_1 }} {{ $estudiante->apellido_1 }}</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('estudiantes.update', $estudiante->documento) }}" method="POST" id="estudianteForm">
                    @csrf
                    @method('PUT')

                    <div class="section-title">Información Personal</div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="documento" class="form-label">Documento <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="documento" id="documento" 
                                   value="{{ old('documento', $estudiante->documento) }}" required readonly>
                            <div class="form-text">Número de documento de identidad (no editable)</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="nombre_1" class="form-label">Primer Nombre <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="nombre_1" id="nombre_1" 
                                   value="{{ old('nombre_1', $estudiante->nombre_1) }}" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nombre_2" class="form-label">Segundo Nombre</label>
                            <input type="text" class="form-control" name="nombre_2" id="nombre_2" 
                                   value="{{ old('nombre_2', $estudiante->nombre_2) }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="apellido_1" class="form-label">Primer Apellido <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="apellido_1" id="apellido_1" 
                                   value="{{ old('apellido_1', $estudiante->apellido_1) }}" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="apellido_2" class="form-label">Segundo Apellido</label>
                            <input type="text" class="form-control" name="apellido_2" id="apellido_2" 
                                   value="{{ old('apellido_2', $estudiante->apellido_2) }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="telefono" class="form-label">Teléfono <span class="text-danger">*</span></label>
                            <input type="tel" class="form-control" name="telefono" id="telefono" 
                                   value="{{ old('telefono', $estudiante->telefono) }}" required>
                        </div>
                    </div>

                    <div class="section-title">Información de Contacto</div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nombre_contacto" class="form-label">Nombre de Contacto</label>
                            <input type="text" class="form-control" name="nombre_contacto" id="nombre_contacto" 
                                   value="{{ old('nombre_contacto', $estudiante->nombre_contacto) }}">
                            <div class="form-text">Persona a contactar en caso de emergencia</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="telefono_contacto" class="form-label">Teléfono de Contacto</label>
                            <input type="tel" class="form-control" name="telefono_contacto" id="telefono_contacto" 
                                   value="{{ old('telefono_contacto', $estudiante->telefono_contacto) }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="eps" class="form-label">EPS</label>
                            <input type="text" class="form-control" name="eps" id="eps" 
                                   value="{{ old('eps', $estudiante->eps) }}">
                            <div class="form-text">Entidad de salud a la que está afiliado</div>
                        </div>
                    </div>

                    <div class="section-title">Información Académica</div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="grupo_id" class="form-label">Grupo <span class="text-danger">*</span></label>
                            <select name="grupo_id" id="grupo_id" class="form-select" required>
                                <option value="" disabled>-- Selecciona un grupo --</option>
                                @foreach ($grupos as $grupo)
                                    <option value="{{ $grupo->id }}" 
                                        {{ old('grupo_id', $estudiante->grupo_id) == $grupo->id ? 'selected' : '' }}>
                                        {{ $grupo->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <a href="{{ route('colaborador.inscripcion') }}" class="btn btn-secondary btn-modern">Cancelar</a>
                        <button type="submit" class="btn btn-primary btn-modern">
                            <i class="bi bi-check-circle me-1"></i> Actualizar Estudiante
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    // Validación básica del formulario
    const form = document.getElementById("estudianteForm");
    form.addEventListener("submit", function(e) {
        // Validar que el teléfono tenga al menos 7 dígitos
        const telefono = document.getElementById("telefono").value;
        if (telefono && telefono.length < 7) {
            e.preventDefault();
            alert("El teléfono debe tener al menos 7 dígitos");
            return false;
        }
        
        // Validar que el teléfono de contacto tenga al menos 7 dígitos si está presente
        const telefonoContacto = document.getElementById("telefono_contacto").value;
        if (telefonoContacto && telefonoContacto.length < 7) {
            e.preventDefault();
            alert("El teléfono de contacto debe tener al menos 7 dígitos");
            return false;
        }
    });
});
</script>

@endsection