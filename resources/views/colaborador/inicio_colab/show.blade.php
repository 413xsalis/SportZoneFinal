@extends('colaborador.inicio_colab.layout')

@section('title', 'Detalles de Usuario')

@section('content')
    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3a0ca3;
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
        
        .detail-item {
            padding: 0.75rem 0;
            border-bottom: 1px solid #f1f3f4;
        }
        
        .detail-label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 0.25rem;
        }
        
        .detail-value {
            color: #343a40;
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
        
        .btn-danger {
            background: linear-gradient(135deg, #e74c3c, #c0392b);
            border: none;
        }
        
        .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(231, 76, 60, 0.4);
        }
        
        .btn-secondary {
            background: linear-gradient(135deg, #6c757d, #495057);
            border: none;
        }
        
        .btn-secondary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(108, 117, 125, 0.4);
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
        
        .file-preview {
            margin-top: 1rem;
            text-align: center;
        }
        
        .file-preview-img {
            max-width: 200px;
            max-height: 200px;
            border-radius: 8px;
            margin-bottom: 0.5rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        
        .empty-state {
            text-align: center;
            padding: 2rem;
            color: #6c757d;
        }
        
        .empty-state i {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: #dee2e6;
        }
        
        @media (max-width: 768px) {
            .app-title {
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
                            <h1 class="mb-1"><i class="bi bi-person-badge me-2"></i> Detalles de Usuario</h1>
                            <p class="mb-0">{{ $usuario->name }} - {{ $usuario->email }}</p>
                        </div>
                    </div>
                </div>
                
                <!-- Migas de pan -->
                
                
                <!-- Información básica -->
                <div class="card card-modern">
                    <div class="card-header-modern">
                        <h5 class="mb-0"><i class="bi bi-info-circle me-2"></i> Información Básica</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="detail-item">
                                    <div class="detail-label">Nombre completo</div>
                                    <div class="detail-value">{{ $usuario->name }}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="detail-item">
                                    <div class="detail-label">Correo electrónico</div>
                                    <div class="detail-value">{{ $usuario->email }}</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="detail-item">
                                    <div class="detail-label">Documento de identidad</div>
                                    <div class="detail-value">{{ $usuario->documento_identidad ?? 'No especificado' }}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="detail-item">
                                    <div class="detail-label">Teléfono</div>
                                    <div class="detail-value">{{ $usuario->telefono ?? 'No especificado' }}</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="detail-item">
                                    <div class="detail-label">Fecha de nacimiento</div>
                                    <div class="detail-value">
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
                
                <!-- Archivos e imágenes -->
                <div class="card card-modern">
                    <div class="card-header-modern">
                        <h5 class="mb-0"><i class="bi bi-images me-2"></i> Archivos e Imágenes</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="detail-item">
                                    <div class="detail-label">Foto de perfil</div>
                                    @if($usuario->foto_perfil && Storage::disk('public')->exists($usuario->foto_perfil))
                                        <div class="file-preview">
                                            <img src="{{ asset('storage/' . $usuario->foto_perfil) }}" alt="Foto de perfil" class="file-preview-img">
                                        </div>
                                    @else
                                        <div class="empty-state">
                                            <i class="bi bi-image"></i>
                                            <p>No hay foto de perfil</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            
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
                
                <!-- Roles asignados -->
                <div class="card card-modern">
                    <div class="card-header-modern">
                        <h5 class="mb-0"><i class="bi bi-shield-lock me-2"></i> Roles Asignados</h5>
                    </div>
                    <div class="card-body">
                        @if($usuario->roles->count() > 0)
                            <div class="d-flex flex-wrap">
                                @foreach($usuario->roles as $role)
                                    <span class="role-badge">{{ $role->name }}</span>
                                @endforeach
                            </div>
                        @else
                            <div class="empty-state">
                                <i class="bi bi-person-x"></i>
                                <p>Este usuario no tiene roles asignados</p>
                            </div>
                        @endif
                    </div>
                </div>
                
                <!-- Información del sistema -->
                <div class="card card-modern">
                    <div class="card-header-modern">
                        <h5 class="mb-0"><i class="bi bi-database me-2"></i> Información del Sistema</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="detail-item">
                                    <div class="detail-label">ID de usuario</div>
                                    <div class="detail-value">{{ $usuario->id }}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="detail-item">
                                    <div class="detail-label">Fecha de creación</div>
                                    <div class="detail-value">
                                        {{ \Carbon\Carbon::parse($usuario->created_at)->format('d/m/Y H:i') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="detail-item">
                                    <div class="detail-label">Última Actualización</div>
                                    <div class="detail-value">
                                        {{ \Carbon\Carbon::parse($usuario->updated_at)->format('d/m/Y H:i') }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="detail-item">
                                    <div class="detail-label">Estado</div>
                                    <div class="detail-value">
                                        @if($usuario->deleted_at)
                                            <span class="badge bg-danger">Inactivo</span>
                                        @else
                                            <span class="badge bg-success">Activo</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection