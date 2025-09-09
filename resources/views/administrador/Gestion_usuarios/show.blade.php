@extends('administrador.Gestion_usuarios.layout')

@section('title', 'Detalles de Usuario')

@section('content')
    <style>
        /* SISTEMA DE VARIABLES CSS PARA MANTENER CONSISTENCIA */
        :root {
            --primary-color: #4361ee;       /* Color primario azul */
            --secondary-color: #3a0ca3;     /* Color secundario azul oscuro */
            --light-bg: #f8f9fa;            /* Color de fondo claro */
            --card-shadow: 0 10px 20px rgba(0, 0, 0, 0.05); /* Sombra suave para tarjetas */
            --hover-shadow: 0 15px 30px rgba(0, 0, 0, 0.1); /* Sombra al hacer hover */
        }
        
        /* ESTILOS GENERALES */
        body {
            background-color: #f5f7fb;      /* Fondo ligeramente azulado */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; /* Fuente moderna */
            color: #343a40;                 /* Color de texto oscuro */
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
            transition: all 0.3s ease; /* Transición suave para efectos hover */
        }
        
        .app-title:hover {
            box-shadow: var(--hover-shadow); /* Efecto de elevación al pasar el mouse */
        }
        
        /* ESTILOS PARA IMÁGENES DE PERFIL */
        .profile-image {
            width: 100px;
            height: 100px;
            border-radius: 50%;             /* Forma circular */
            object-fit: cover;              /* Ajuste de imagen para cubrir el contenedor */
            border: 3px solid rgba(255, 255, 255, 0.3); /* Borde semitransparente */
        }
        
        /* AVATAR POR DEFECTO CUANDO NO HAY FOTO */
        .default-avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.2); /* Fondo semitransparente */
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            border: 3px solid rgba(255, 255, 255, 0.3);
            font-size: 2.5rem; /* Tamaño grande para el icono */
        }
        
        /* TARJETAS MODERNAS CON EFECTOS VISUALES */
        .card-modern {
            border: none;                   /* Sin borde por defecto */
            border-radius: 16px;            /* Bordes muy redondeados */
            box-shadow: var(--card-shadow); /* Sombra suave */
            transition: all 0.3s ease;      /* Transición para efectos hover */
            overflow: hidden;               /* Evita que el contenido se salga */
            margin-bottom: 1.5rem;
        }
        
        .card-modern:hover {
            box-shadow: var(--hover-shadow); /* Efecto de elevación al pasar el mouse */
        }
        
        /* ENCABEZADO DE TARJETA */
        .card-header-modern {
            background: white;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05); /* Línea divisoria sutil */
            padding: 1.25rem 1.5rem;
        }
        
        /* ESTILOS PARA ELEMENTOS DE DETALLE */
        .detail-item {
            padding: 0.75rem 0;
            border-bottom: 1px solid #f1f3f4; /* Línea divisoria sutil */
        }
        
        .detail-label {
            font-weight: 600;               /* Texto en negrita */
            color: #495057;                 /* Color gris oscuro */
            margin-bottom: 0.25rem;
        }
        
        .detail-value {
            color: #343a40;                 /* Color de texto principal */
        }
        
        /* BOTONES MODERNOS CON EFECTOS */
        .btn-modern {
            border-radius: 50px;            /* Bordes completamente redondeados */
            padding: 0.75rem 1.5rem;        /* Espaciado interno generoso */
            font-weight: 500;               /* Peso de fuente medio */
            transition: all 0.3s ease;      /* Transición para efectos hover */
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border: none;                   /* Sin borde */
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);    /* Efecto de elevación */
            box-shadow: 0 5px 15px rgba(67, 97, 238, 0.4); /* Sombra colorida */
        }
        
        .btn-danger {
            background: linear-gradient(135deg, #e74c3c, #c0392b); /* Gradiente rojo */
            border: none;
        }
        
        .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(231, 76, 60, 0.4);
        }
        
        .btn-secondary {
            background: linear-gradient(135deg, #6c757d, #495057); /* Gradiente gris */
            border: none;
        }
        
        .btn-secondary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(108, 117, 125, 0.4);
        }
        
        /* BADGES PARA ROLES */
        .role-badge {
            display: inline-block;
            padding: 0.5em 0.8em;
            border-radius: 50px;            /* Forma de píldora */
            font-weight: 500;
            font-size: 0.85em;
            background-color: var(--primary-color); /* Fondo color primario */
            color: white;                   /* Texto blanco */
            margin-right: 0.5rem;
            margin-bottom: 0.5rem;
        }
        
        /* VISTA PREVIA DE ARCHIVOS */
        .file-preview {
            margin-top: 1rem;
            text-align: center;
        }
        
        .file-preview-img {
            max-width: 200px;
            max-height: 200px;
            border-radius: 8px;
            margin-bottom: 0.5rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Sombra suave */
        }
        
        /* ESTADO VACÍO (CUANDO NO HAY CONTENIDO) */
        .empty-state {
            text-align: center;
            padding: 2rem;
            color: #6c757d;                 /* Color gris */
        }
        
        .empty-state i {
            font-size: 3rem;                /* Icono grande */
            margin-bottom: 1rem;
            color: #dee2e6;                 /* Color gris muy claro */
        }
        
        /* RESPONSIVIDAD PARA DISPOSITIVOS MÓVILES */
        @media (max-width: 768px) {
            .app-title {
                padding: 1rem;              /* Menos padding en móviles */
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
                            <h1 class="mb-1"><i class="bi bi-person-badge me-2"></i> Detalles de Usuario</h1>
                            <p class="mb-0">{{ $usuario->name }} - {{ $usuario->email }}</p> <!-- Info del usuario -->
                        </div>
                    </div>
                </div>
                
                <!-- MIGAS DE PAN (BREADCRUMBS) PARA NAVEGACIÓN -->
                <nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#" class="text-decoration-none"><i class="bi bi-house-door"></i> Inicio</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.gestion') }}" class="text-decoration-none">Gestión de Usuarios</a></li>
                        <li class="breadcrumb-item active">Detalles de Usuario</li> <!-- Nivel actual -->
                    </ol>
                </nav>
                
                <!-- TARJETA DE INFORMACIÓN BÁSICA -->
                <div class="card card-modern">
                    <div class="card-header-modern">
                        <h5 class="mb-0"><i class="bi bi-info-circle me-2"></i> Información Básica</h5>
                    </div>
                    <div class="card-body">
                        <!-- FILA: NOMBRE Y EMAIL -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="detail-item">
                                    <div class="detail-label">Nombre completo</div>
                                    <div class="detail-value">{{ $usuario->name }}</div> <!-- Nombre del usuario -->
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="detail-item">
                                    <div class="detail-label">Correo electrónico</div>
                                    <div class="detail-value">{{ $usuario->email }}</div> <!-- Email del usuario -->
                                </div>
                            </div>
                        </div>
                        
                        <!-- FILA: DOCUMENTO Y TELÉFONO -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="detail-item">
                                    <div class="detail-label">Documento de identidad</div>
                                    <div class="detail-value">{{ $usuario->documento_identidad ?? 'No especificado' }}</div> <!-- Valor o mensaje por defecto -->
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="detail-item">
                                    <div class="detail-label">Teléfono</div>
                                    <div class="detail-value">{{ $usuario->telefono ?? 'No especificado' }}</div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- FILA: FECHA DE NACIMIENTO Y EPS -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="detail-item">
                                    <div class="detail-label">Fecha de nacimiento</div>
                                    <div class="detail-value">
                                        <!-- FORMATEO DE FECHA CON CARBON -->
                                        @if($usuario->fecha_nacimiento)
                                            {{ \Carbon\Carbon::parse($usuario->fecha_nacimiento)->format('d/m/Y') }}
                                        @else
                                            No especificada
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="detail-item">
                                    <div class="detail-label">EPS</div>
                                    <div class="detail-value">{{ $usuario->eps ?? 'No especificada' }}</div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- FILA: DIRECCIÓN -->
                        <div class="row">
                            <div class="col-12">
                                <div class="detail-item">
                                    <div class="detail-label">Dirección de hogar</div>
                                    <div class="detail-value">{{ $usuario->direccion_hogar ?? 'No especificada' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- TARJETA DE ARCHIVOS E IMÁGENES -->
                <div class="card card-modern">
                    <div class="card-header-modern">
                        <h5 class="mb-0"><i class="bi bi-images me-2"></i> Archivos e Imágenes</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- FOTO DE PERFIL -->
                            <div class="col-md-4">
                                <div class="detail-item">
                                    <div class="detail-label">Foto de perfil</div>
                                    @if($usuario->foto_perfil && Storage::disk('public')->exists($usuario->foto_perfil))
                                        <div class="file-preview">
                                            <img src="{{ asset('storage/' . $usuario->foto_perfil) }}" alt="Foto de perfil" class="file-preview-img">
                                        </div>
                                    @else
                                        <!-- ESTADO VACÍO CUANDO NO HAY IMAGEN -->
                                        <div class="empty-state">
                                            <i class="bi bi-image"></i>
                                            <p>No hay foto de perfil</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- FOTO DE DOCUMENTO -->
                            <div class="col-md-4">
                                <div class="detail-item">
                                    <div class="detail-label">Foto de documento</div>
                                    @if($usuario->foto_documento && Storage::disk('public')->exists($usuario->foto_documento))
                                        <div class="file-preview">
                                            <img src="{{ asset('storage/' . $usuario->foto_documento) }}" alt="Foto de documento" class="file-preview-img">
                                        </div>
                                    @else
                                        <div class="empty-state">
                                            <i class="bi bi-file-image"></i>
                                            <p>No hay foto de documento</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- LOGO PERSONALIZADO -->
                            <div class="col-md-4">
                                <div class="detail-item">
                                    <div class="detail-label">Logo personalizado</div>
                                    @if($usuario->logo_personalizado && Storage::disk('public')->exists($usuario->logo_personalizado))
                                        <div class="file-preview">
                                            <img src="{{ asset('storage/' . $usuario->logo_personalizado) }}" alt="Logo personalizado" class="file-preview-img">
                                        </div>
                                    @else
                                        <div class="empty-state">
                                            <i class="bi bi-star"></i>
                                            <p>No hay logo personalizado</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- TARJETA DE ROLES ASIGNADOS -->
                <div class="card card-modern">
                    <div class="card-header-modern">
                        <h5 class="mb-0"><i class="bi bi-shield-lock me-2"></i> Roles Asignados</h5>
                    </div>
                    <div class="card-body">
                        @if($usuario->roles->count() > 0)
                            <div class="d-flex flex-wrap">
                                <!-- ITERA SOBRE LOS ROLES DEL USUARIO -->
                                @foreach($usuario->roles as $role)
                                    <span class="role-badge">{{ $role->name }}</span> <!-- Badge por cada rol -->
                                @endforeach
                            </div>
                        @else
                            <!-- ESTADO VACÍO CUANDO NO HAY ROLES -->
                            <div class="empty-state">
                                <i class="bi bi-person-x"></i>
                                <p>Este usuario no tiene roles asignados</p>
                            </div>
                        @endif
                    </div>
                </div>
                
                <!-- TARJETA DE INFORMACIÓN DEL SISTEMA -->
                <div class="card card-modern">
                    <div class="card-header-modern">
                        <h5 class="mb-0"><i class="bi bi-database me-2"></i> Información del Sistema</h5>
                    </div>
                    <div class="card-body">
                        <!-- FILA: ID Y FECHA DE CREACIÓN -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="detail-item">
                                    <div class="detail-label">ID de usuario</div>
                                    <div class="detail-value">{{ $usuario->id }}</div> <!-- ID del usuario -->
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="detail-item">
                                    <div class="detail-label">Fecha de creación</div>
                                    <div class="detail-value">
                                        <!-- FORMATEO DE FECHA CON CARBON -->
                                        {{ \Carbon\Carbon::parse($usuario->created_at)->format('d/m/Y H:i') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- FILA: ÚLTIMA ACTUALIZACIÓN Y ESTADO -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="detail-item">
                                    <div class="detail-label">Última actualización</div>
                                    <div class="detail-value">
                                        {{ \Carbon\Carbon::parse($usuario->updated_at)->format('d/m/Y H:i') }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="detail-item">
                                    <div class="detail-label">Estado</div>
                                    <div class="detail-value">
                                        <!-- INDICADOR DE ESTADO (ACTIVO/INACTIVO) -->
                                        @if($usuario->deleted_at)
                                            <span class="badge bg-danger">Inactivo</span> <!-- Usuario eliminado/desactivado -->
                                        @else
                                            <span class="badge bg-success">Activo</span> <!-- Usuario activo -->
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- BARRA DE ACCIONES -->
                <div class="d-flex justify-content-between mt-4">
                    <!-- BOTÓN PARA VOLVER AL LISTADO -->
                    <a href="{{ route('admin.gestion') }}" class="btn btn-secondary btn-modern">
                        <i class="bi bi-arrow-left me-2"></i> Volver al listado
                    </a>
                    <div>
                        <!-- BOTÓN PARA EDITAR USUARIO -->
                        <a href="{{ route('usuarios.edit', $usuario) }}" class="btn btn-primary btn-modern me-2">
                            <i class="bi bi-pencil me-2"></i> Editar Usuario
                        </a>
                        
                        <!-- FORMULARIO PARA ELIMINAR O RESTAURAR USUARIO -->
                        @if(!$usuario->deleted_at)
                            <!-- ELIMINAR USUARIO ACTIVO -->
                            <form action="{{ route('usuarios.destroy', $usuario) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-modern" onclick="return confirm('¿Estás seguro de que deseas eliminar este usuario?')">
                                    <i class="bi bi-trash me-2"></i> Eliminar
                                </button>
                            </form>
                        @else
                            <!-- RESTAURAR USUARIO ELIMINADO -->
                            <form action="{{ route('usuarios.restore', $usuario->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-success btn-modern">
                                    <i class="bi bi-arrow-clockwise me-2"></i> Restaurar
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- SCRIPTS DE BOOTSTRAP -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection