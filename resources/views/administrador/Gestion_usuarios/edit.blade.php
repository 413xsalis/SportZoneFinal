@extends('administrador.Gestion_usuarios.layout')

@section('title', 'Editar Usuario')

@section('content')
    <style>
        /* SISTEMA DE VARIABLES CSS PARA MANTENER CONSISTENCIA */
        :root {
            --primary-color: #4361ee;
            /* Color primario azul */
            --secondary-color: #3a0ca3;
            /* Color secundario azul oscuro */
            --success-color: #4cc9f0;
            /* Color para elementos de éxito */
            --light-bg: #f8f9fa;
            /* Color de fondo claro */
            --card-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
            /* Sombra suave para tarjetas */
            --hover-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            /* Sombra al hacer hover */
        }

        /* ESTILOS GENERALES */
        body {
            background-color: #f5f7fb;
            /* Fondo ligeramente azulado */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            /* Fuente moderna */
            color: #343a40;
            /* Color de texto oscuro */
        }

        /* CONTENEDOR PRINCIPAL CON ANCHO MÁXIMO */
        .app-container {
            max-width: 1400px;
            margin: 0 auto;
        }

        /* ENCABEZADO CON GRADIENTE Y EFECTOS VISUALES */
        .app-title {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border-radius: 16px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            box-shadow: var(--card-shadow);
            transition: all 0.3s ease;
            /* Transición suave para efectos hover */
        }

        .app-title:hover {
            box-shadow: var(--hover-shadow);
            /* Efecto de elevación al pasar el mouse */
        }

        /* ESTILOS PARA IMÁGENES DE PERFIL */
        .profile-image {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            /* Forma circular */
            object-fit: cover;
            /* Ajuste de imagen para cubrir el contenedor */
            border: 3px solid rgba(255, 255, 255, 0.3);
            /* Borde semitransparente */
        }

        /* AVATAR POR DEFECTO CUANDO NO HAY FOTO */
        .default-avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.2);
            /* Fondo semitransparente */
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            border: 3px solid rgba(255, 255, 255, 0.3);
            font-size: 2.5rem;
            /* Tamaño grande para el icono */
        }

        /* TARJETAS MODERNAS CON EFECTOS VISUALES */
        .card-modern {
            border: none;
            /* Sin borde por defecto */
            border-radius: 16px;
            /* Bordes muy redondeados */
            box-shadow: var(--card-shadow);
            /* Sombra suave */
            transition: all 0.3s ease;
            /* Transición para efectos hover */
            overflow: hidden;
            /* Evita que el contenido se salga */
            margin-bottom: 1.5rem;
        }

        .card-modern:hover {
            box-shadow: var(--hover-shadow);
            /* Efecto de elevación al pasar el mouse */
        }

        /* ENCABEZADO DE TARJETA */
        .card-header-modern {
            background: white;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            /* Línea divisoria sutil */
            padding: 1.25rem 1.5rem;
        }

        /* FORMULARIOS MODERNOS */
        .form-control-modern,
        .form-select-modern {
            border-radius: 12px;
            /* Bordes redondeados */
            padding: 0.75rem 1rem;
            /* Espaciado interno generoso */
            border: 1px solid #e2e8f0;
            /* Borde sutil */
            transition: all 0.3s ease;
            /* Transición para efectos focus */
        }

        .form-control-modern:focus,
        .form-select-modern:focus {
            border-color: var(--primary-color);
            /* Borde color primario al enfocar */
            box-shadow: 0 0 0 0.25rem rgba(67, 97, 238, 0.15);
            /* Sombra de enfoque */
        }

        /* BOTONES MODERNOS CON EFECTOS */
        .btn-modern {
            border-radius: 50px;
            /* Bordes completamente redondeados */
            padding: 0.75rem 1.5rem;
            /* Espaciado interno generoso */
            font-weight: 500;
            /* Peso de fuente medio */
            transition: all 0.3s ease;
            /* Transición para efectos hover */
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border: none;
            /* Sin borde */
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            /* Efecto de elevación */
            box-shadow: 0 5px 15px rgba(67, 97, 238, 0.4);
            /* Sombra colorida */
        }

        /* INDICADOR DE CAMPOS OBLIGATORIOS */
        .required-field::after {
            content: " *";
            /* Asterisco rojo */
            color: #e74a3b;
            /* Color rojo para indicar obligatoriedad */
        }

        /* TÍTULOS DE SECCIÓN */
        .section-title {
            font-size: 1.1rem;
            color: var(--primary-color);
            /* Color primario */
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid var(--primary-color);
            /* Línea inferior decorativa */
        }

        /* BADGES PARA ROLES */
        .role-badge {
            display: inline-block;
            padding: 0.5em 0.8em;
            border-radius: 50px;
            /* Forma de píldora */
            font-weight: 500;
            font-size: 0.85em;
            background-color: var(--primary-color);
            /* Fondo color primario */
            color: white;
            /* Texto blanco */
            margin-right: 0.5rem;
            margin-bottom: 0.5rem;
        }

        /* BARRA DE ACCIONES FIJA EN LA PARTE INFERIOR */
        .footer-actions {
            background-color: white;
            padding: 1.5rem;
            border-radius: 16px;
            box-shadow: var(--card-shadow);
            position: sticky;
            /* Posición fija al hacer scroll */
            bottom: 20px;
            /* Separación del fondo */
            z-index: 100;
            /* Asegura que esté por encima */
        }

        /* ESTILOS PARA SELECT2 (SELECTORES MEJORADOS) */
        .select2-container--default .select2-selection--multiple {
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 0.375rem 0.75rem;
            min-height: 46px;
            /* Altura mínima consistente */
        }

        .select2-container--default.select2-container--focus .select2-selection--multiple {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(67, 97, 238, 0.15);
        }

        /* CONTENEDOR PARA SUBIDA DE ARCHIVOS */
        .file-upload-container {
            border: 2px dashed #e2e8f0;
            /* Borde discontinuo */
            border-radius: 12px;
            padding: 1.5rem;
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
            /* Indica que es clickeable */
        }

        .file-upload-container:hover {
            border-color: var(--primary-color);
            background-color: rgba(67, 97, 238, 0.05);
            /* Fondo sutil al pasar mouse */
        }

        /* VISTA PREVIA DE ARCHIVOS */
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

        /* RESPONSIVIDAD PARA DISPOSITIVOS MÓVILES */
        @media (max-width: 768px) {
            .app-title {
                padding: 1rem;
                /* Menos padding en móviles */
            }

            .footer-actions {
                padding: 1rem;
                /* Menos padding en móviles */
            }
        }
    </style>

    <main class="content">
        <div class="container py-5">
            <div class="app-container">
                <!-- ENCABEZADO DE PÁGINA CON FOTO DE PERFIL -->
                <div class="app-title">
                    <div class="d-flex align-items-center">
                        <!-- MUESTRA LA FOTO DE PERFIL O AVATAR POR DEFECTO -->
                        @if($usuario->foto_perfil && Storage::disk('public')->exists($usuario->foto_perfil))
                            <img src="{{ asset('storage/' . $usuario->foto_perfil) }}" alt="Foto de perfil"
                                class="profile-image me-3">
                        @else
                            <div class="default-avatar me-3">
                                <i class="bi bi-person"></i> <!-- Icono de persona -->
                            </div>
                        @endif
                        <div>
                            <h1 class="mb-1"><i class="bi bi-pencil-square me-2"></i> Editar Usuario</h1>
                            <p class="mb-0">{{ $usuario->name }} - {{ $usuario->email }}</p> <!-- Info del usuario -->
                        </div>
                    </div>
                </div>

                <!-- MIGAS DE PAN (BREADCRUMBS) PARA NAVEGACIÓN -->
                <nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#" class="text-decoration-none"><i
                                    class="bi bi-house-door"></i> Inicio</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.gestion') }}"
                                class="text-decoration-none">Gestión de Usuarios</a></li>
                        <li class="breadcrumb-item active">Editar Usuario</li> <!-- Nivel actual -->
                    </ol>
                </nav>

                <!-- FORMULARIO DE EDICIÓN (METHOD PUT PARA ACTUALIZACIÓN) -->
                <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST" id="userForm"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT') <!-- Método HTTP PUT para actualización -->

                    <!-- TARJETA DE INFORMACIÓN BÁSICA -->
                    <div class="card card-modern">
                        <div class="card-header-modern">
                            <h5 class="mb-0"><i class="bi bi-info-circle me-2"></i> Información Básica</h5>
                        </div>
                        <div class="card-body">
                            <!-- FILA DE CAMPOS: NOMBRE Y EMAIL -->
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="name" class="form-label required-field">Nombre completo</label>
                                        <input type="text" class="form-control form-control-modern" id="name" name="name"
                                            value="{{ old('name', $usuario->name) }}" required>
                                        <!-- Valor antiguo o actual -->
                                        @error('name')
                                            <div class="text-danger mt-1">{{ $message }}</div> <!-- Mensaje de error -->
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

                            <!-- FILA DE CAMPOS: DOCUMENTO Y TELÉFONO -->
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="documento_identidad" class="form-label">Documento de identidad</label>
                                        <input type="text" class="form-control form-control-modern" id="documento_identidad"
                                            name="documento_identidad"
                                            value="{{ old('documento_identidad', $usuario->documento_identidad) }}">
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

                            <!-- FILA DE CAMPOS: FECHA DE NACIMIENTO Y EPS -->
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento</label>
                                        <input type="date" class="form-control form-control-modern" id="fecha_nacimiento"
                                            name="fecha_nacimiento"
                                            value="{{ old('fecha_nacimiento', $usuario->fecha_nacimiento) }}">
                                        @error('fecha_nacimiento')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="eps" class="form-label">EPS</label>
                                        <input type="text" class="form-control form-control-modern" id="eps" name="eps"
                                            value="{{ old('eps', $usuario->eps) }}">
                                        @error('eps')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- CAMPO DE DIRECCIÓN (TEXTAREA) -->
                            <div class="row mb-4">
                                <div class="col-12">
                                    <div class="form-group mb-3">
                                        <label for="direccion_hogar" class="form-label">Dirección de hogar</label>
                                        <textarea class="form-control form-control-modern" id="direccion_hogar"
                                            name="direccion_hogar"
                                            rows="3">{{ old('direccion_hogar', $usuario->direccion_hogar) }}</textarea>
                                        @error('direccion_hogar')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- TARJETA DE GESTIÓN DE ROLES -->
                    <div class="card card-modern">
                        <div class="card-header-modern">
                            <h5 class="mb-0"><i class="bi bi-shield-lock me-2"></i> Gestión de Roles</h5>
                        </div>
                        <div class="card-body">
                            <!-- ALERTA INFORMATIVA -->
                            <div class="alert alert-info">
                                <i class="bi bi-info-circle me-2"></i> Seleccione uno o varios roles para asignar al
                                usuario.
                                Los roles actuales del usuario están resaltados.
                            </div>

                            <div class="form-group mb-4">
                                <label for="roles" class="form-label required-field">Roles del usuario</label>
                                <!-- SELECTOR MÚLTIPLE DE ROLES CON SELECT2 -->
                                <select name="roles[]" id="roles" class="form-control form-select-modern"
                                    multiple="multiple" required>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->name }}" {{ $usuario->hasRole($role->name) ? 'selected' : '' }}>{{ $role->name }} <!-- Marca como seleccionados los roles actuales -->
                                        </option>
                                    @endforeach
                                </select>
                                @error('roles')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror

                                <!-- MUESTRA LOS ROLES ACTUALMENTE ASIGNADOS -->
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

                <!-- BARRA DE ACCIONES EN LA PARTE INFERIOR -->
                <div class="footer-actions mt-4">
                    <div class="d-flex justify-content-between">
                        <!-- BOTÓN PARA VOLVER AL LISTADO -->
                        <a href="{{ route('admin.gestion') }}" class="btn btn-secondary btn-modern">
                            <i class="bi bi-arrow-left me-2"></i> Volver al listado
                        </a>
                        <div>
                            <!-- BOTÓN PARA ENVIAR EL FORMULARIO -->
                            <button type="submit" form="userForm" class="btn btn-primary btn-modern">
                                <i class="bi bi-check2-circle me-2"></i> Actualizar Usuario
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- SCRIPTS EXTERNOS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <!-- SCRIPTS PERSONALIZADOS -->
    <script>
        $(document).ready(function () {
            // INICIALIZACIÓN DE SELECT2 PARA SELECTOR DE ROLES
            $('#roles').select2({
                placeholder: "Seleccione uno o varios roles",
                allowClear: true,           // Permite limpiar la selección
                width: '100%'               // Ancho completo
            });

            // VALIDACIÓN DEL FORMULARIO AL ENVIAR
            $('#userForm').on('submit', function (e) {
                let isValid = true;

                // VALIDAR CAMPOS REQUERIDOS (NOMBRE Y EMAIL)
                $('#name, #email').each(function () {
                    if ($.trim($(this).val()) === '') {
                        isValid = false;
                        $(this).addClass('is-invalid'); // Marcar como inválido
                    } else {
                        $(this).removeClass('is-invalid');
                    }
                });

                // VALIDAR QUE SE HAYA SELECCIONADO AL MENOS UN ROL
                if ($('#roles').val() === null || $('#roles').val().length === 0) {
                    isValid = false;
                    $('#roles').next('.select2-container').addClass('is-invalid');
                } else {
                    $('#roles').next('.select2-container').removeClass('is-invalid');
                }

                // PREVENIR ENVÍO SI NO ES VÁLIDO
                if (!isValid) {
                    e.preventDefault();
                    alert('Por favor, complete todos los campos requeridos.');
                }
            });

            // VISTA PREVIA DE IMÁGENES AL SELECCIONAR ARCHIVOS
            $('input[type="file"]').change(function (e) {
                const input = $(this);
                const previewContainer = input.siblings('.file-preview');

                if (this.files && this.files[0]) {
                    const reader = new FileReader();

                    reader.onload = function (e) {
                        // CREAR O ACTUALIZAR CONTENEDOR DE VISTA PREVIA
                        if (!previewContainer.length) {
                            input.after('<div class="file-preview"><img class="file-preview-img" src="' + e.target.result + '" alt="Vista previa"><div class="text-muted">Nueva imagen</div></div>');
                        } else {
                            previewContainer.find('.file-preview-img').attr('src', e.target.result);
                            previewContainer.find('.text-muted').text('Nueva imagen');
                        }
                    }

                    reader.readAsDataURL(this.files[0]); // Leer archivo como URL de datos
                }
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@endsection