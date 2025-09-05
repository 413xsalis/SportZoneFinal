@extends('administrador.Gestion_usuarios.layout')

@section('title', 'Editar Usuario')

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
        
        body {
            background-color: #f5f7fb;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #343a40;
        }
        
        .app-container {
            max-width: 1400px;
            margin: 0 auto;
        }
        
        .app-title {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border-radius: 16px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            box-shadow: var(--card-shadow);
            transition: all 0.3s ease;
        }
        
        .app-title:hover {
            box-shadow: var(--hover-shadow);
        }
        
        .profile-image {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid rgba(255, 255, 255, 0.3);
        }
        
        .default-avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            border: 3px solid rgba(255, 255, 255, 0.3);
            font-size: 2.5rem;
        }
        
        .card-modern {
            border: none;
            border-radius: 16px;
            box-shadow: var(--card-shadow);
            transition: all 0.3s ease;
            overflow: hidden;
            margin-bottom: 1.5rem;
        }
        
        .card-modern:hover {
            box-shadow: var(--hover-shadow);
        }
        
        .card-header-modern {
            background: white;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            padding: 1.25rem 1.5rem;
        }
        
        .form-control-modern, .form-select-modern {
            border-radius: 12px;
            padding: 0.75rem 1rem;
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
        }
        
        .form-control-modern:focus, .form-select-modern:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(67, 97, 238, 0.15);
        }
        
        .btn-modern {
            border-radius: 50px;
            padding: 0.75rem 1.5rem;
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
            background: linear-gradient(135deg, #6c757d, #495057);
            border: none;
        }
        
        .btn-secondary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(108, 117, 125, 0.4);
        }
        
        .required-field::after {
            content: " *";
            color: #e74a3b;
        }
        
        .section-title {
            font-size: 1.1rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid var(--primary-color);
        }
        
        .role-badge {
            display: inline-block;
            padding: 0.5em 0.8em;
            border-radius: 50px;
            font-weight: 500;
            font-size: 0.85em;
            background-color: var(--primary-color);
            color: white;
            margin-right: 0.5rem;
            margin-bottom: 0.5rem;
        }
        
        .footer-actions {
            background-color: white;
            padding: 1.5rem;
            border-radius: 16px;
            box-shadow: var(--card-shadow);
            position: sticky;
            bottom: 20px;
            z-index: 100;
        }
        
        .select2-container--default .select2-selection--multiple {
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 0.375rem 0.75rem;
            min-height: 46px;
        }
        
        .select2-container--default.select2-container--focus .select2-selection--multiple {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(67, 97, 238, 0.15);
        }
        
        .file-upload-container {
            border: 2px dashed #e2e8f0;
            border-radius: 12px;
            padding: 1.5rem;
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .file-upload-container:hover {
            border-color: var(--primary-color);
            background-color: rgba(67, 97, 238, 0.05);
        }
        
        .file-preview {
            margin-top: 1rem;
            text-align: center;
        }
        
        .file-preview-img {
            max-width: 150px;
            max-height: 150px;
            border-radius: 8px;
            margin-bottom: 0.5rem;
        }
        
        @media (max-width: 768px) {
            .app-title {
                padding: 1rem;
            }
            
            .footer-actions {
                padding: 1rem;
            }
        }
    </style>

    <main class="content">
        <div class="container py-5">
            <div class="app-container">
                <!-- Encabezado de página -->
                <div class="app-title">
                    <div class="d-flex align-items-center">
                        @if($usuario->foto_perfil && Storage::disk('public')->exists($usuario->foto_perfil))
                            <img src="{{ asset('storage/' . $usuario->foto_perfil) }}" alt="Foto de perfil"
                                class="profile-image me-3">
                        @else
                            <div class="default-avatar me-3">
                                <i class="bi bi-person"></i>
                            </div>
                        @endif
                        <div>
                            <h1 class="mb-1"><i class="bi bi-pencil-square me-2"></i> Editar Usuario</h1>
                            <p class="mb-0">{{ $usuario->name }} - {{ $usuario->email }}</p>
                        </div>
                    </div>
                </div>
                
                <!-- Migas de pan -->
                <nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#" class="text-decoration-none"><i class="bi bi-house-door"></i> Inicio</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.gestion') }}" class="text-decoration-none">Gestión de Usuarios</a></li>
                        <li class="breadcrumb-item active">Editar Usuario</li>
                    </ol>
                </nav>
                
                <!-- Formulario de edición -->
                <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST" id="userForm" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="card card-modern">
                        <div class="card-header-modern">
                            <h5 class="mb-0"><i class="bi bi-info-circle me-2"></i> Información Básica</h5>
                        </div>
                        <div class="card-body">
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="name" class="form-label required-field">Nombre completo</label>
                                        <input type="text" class="form-control form-control-modern" id="name" name="name" 
                                               value="{{ old('name', $usuario->name) }}" required>
                                        @error('name')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="email" class="form-label required-field">Correo electrónico</label>
                                        <input type="email" class="form-control form-control-modern" id="email" name="email" 
                                               value="{{ old('email', $usuario->email) }}" required>
                                        @error('email')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="documento_identidad" class="form-label">Documento de identidad</label>
                                        <input type="text" class="form-control form-control-modern" id="documento_identidad" 
                                               name="documento_identidad" value="{{ old('documento_identidad', $usuario->documento_identidad) }}">
                                        @error('documento_identidad')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="telefono" class="form-label">Teléfono</label>
                                        <input type="text" class="form-control form-control-modern" id="telefono" 
                                               name="telefono" value="{{ old('telefono', $usuario->telefono) }}">
                                        @error('telefono')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento</label>
                                        <input type="date" class="form-control form-control-modern" id="fecha_nacimiento" 
                                               name="fecha_nacimiento" value="{{ old('fecha_nacimiento', $usuario->fecha_nacimiento) }}">
                                        @error('fecha_nacimiento')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="eps" class="form-label">EPS</label>
                                        <input type="text" class="form-control form-control-modern" id="eps" 
                                               name="eps" value="{{ old('eps', $usuario->eps) }}">
                                        @error('eps')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row mb-4">
                                <div class="col-12">
                                    <div class="form-group mb-3">
                                        <label for="direccion_hogar" class="form-label">Dirección de hogar</label>
                                        <textarea class="form-control form-control-modern" id="direccion_hogar" 
                                                  name="direccion_hogar" rows="3">{{ old('direccion_hogar', $usuario->direccion_hogar) }}</textarea>
                                        @error('direccion_hogar')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
        
                    
                    <!-- Sección de roles -->
                    <div class="card card-modern">
                        <div class="card-header-modern">
                            <h5 class="mb-0"><i class="bi bi-shield-lock me-2"></i> Gestión de Roles</h5>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-info">
                                <i class="bi bi-info-circle me-2"></i> Seleccione uno o varios roles para asignar al usuario. 
                                Los roles actuales del usuario están resaltados.
                            </div>
                            
                            <div class="form-group mb-4">
                                <label for="roles" class="form-label required-field">Roles del usuario</label>
                                <select name="roles[]" id="roles" class="form-control form-select-modern" multiple="multiple" required>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->name }}" {{ $usuario->hasRole($role->name) ? 'selected' : '' }}>
                                            {{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('roles')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                                
                                <div class="mt-3">
                                    <p class="mb-2">Roles actualmente asignados:</p>
                                    @foreach($usuario->roles as $role)
                                        <span class="role-badge">{{ $role->name }}</span>
                                    @endforeach
                                    @if($usuario->roles->count() == 0)
                                        <span class="text-muted">Este usuario no tiene roles asignados</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                
                <!-- Acciones de pie de página -->
                <div class="footer-actions mt-4">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.gestion') }}" class="btn btn-secondary btn-modern">
                            <i class="bi bi-arrow-left me-2"></i> Volver al listado
                        </a>
                        <div>
                            <button type="submit" form="userForm" class="btn btn-primary btn-modern">
                                <i class="bi bi-check2-circle me-2"></i> Actualizar Usuario
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            // Inicializar Select2 para el select múltiple de roles
            $('#roles').select2({
                placeholder: "Seleccione uno o varios roles",
                allowClear: true,
                width: '100%'
            });
            
            // Validación básica del formulario
            $('#userForm').on('submit', function(e) {
                let isValid = true;
                
                // Validar campos requeridos
                $('#name, #email').each(function() {
                    if ($.trim($(this).val()) === '') {
                        isValid = false;
                        $(this).addClass('is-invalid');
                    } else {
                        $(this).removeClass('is-invalid');
                    }
                });
                
                // Validar que se haya seleccionado al menos un rol
                if ($('#roles').val() === null || $('#roles').val().length === 0) {
                    isValid = false;
                    $('#roles').next('.select2-container').addClass('is-invalid');
                } else {
                    $('#roles').next('.select2-container').removeClass('is-invalid');
                }
                
                if (!isValid) {
                    e.preventDefault();
                    // Mostrar mensaje de error
                    alert('Por favor, complete todos los campos requeridos.');
                }
            });
            
            // Vista previa de imágenes al seleccionar archivos
            $('input[type="file"]').change(function(e) {
                const input = $(this);
                const previewContainer = input.siblings('.file-preview');
                
                if (this.files && this.files[0]) {
                    const reader = new FileReader();
                    
                    reader.onload = function(e) {
                        if (!previewContainer.length) {
                            input.after('<div class="file-preview"><img class="file-preview-img" src="'+e.target.result+'" alt="Vista previa"><div class="text-muted">Nueva imagen</div></div>');
                        } else {
                            previewContainer.find('.file-preview-img').attr('src', e.target.result);
                            previewContainer.find('.text-muted').text('Nueva imagen');
                        }
                    }
                    
                    reader.readAsDataURL(this.files[0]);
                }
            });
        });
    </script>
@endsection