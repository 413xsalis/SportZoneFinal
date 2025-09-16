@extends('instructor.inicio.layout')

@section('title', 'Perfil de Usuario')

@section('content')
    <style>
        :root {
            --primary-color: #6366f1;
            --primary-hover: #4f46e5;
            --secondary-color: #f8fafc;
            --text-primary: #1e293b;
            --text-secondary: #64748b;
            --border-color: #e2e8f0;
            --card-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f9fafb;
            color: var(--text-primary);
            padding-top: 0;
        }
        
        .profile-container {
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .profile-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: var(--card-shadow);
            margin-bottom: 24px;
            position: relative;
        }
        
        .profile-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 120px;
            background: rgba(255, 255, 255, 0.1);
        }
        
        .profile-avatar {
            width: 130px;
            height: 130px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid white;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
            transition: var(--transition);
        }
        
        .profile-avatar:hover {
            transform: scale(1.03);
        }
        
        .avatar-edit-btn {
            position: absolute;
            bottom: 10px;
            right: 10px;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: var(--transition);
        }
        
        .avatar-edit-btn:hover {
            background: var(--secondary-color);
            transform: rotate(10deg);
        }
        
        .profile-badge {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 6px 16px;
            font-weight: 500;
        }
        
        .nav-pills .nav-link {
            border-radius: 12px;
            padding: 14px 20px;
            margin-bottom: 8px;
            color: var(--text-secondary);
            transition: var(--transition);
            display: flex;
            align-items: center;
        }
        
        .nav-pills .nav-link i {
            margin-right: 12px;
            font-size: 1.2rem;
        }
        
        .nav-pills .nav-link.active {
            background-color: white;
            color: var(--primary-color);
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.2);
            font-weight: 600;
        }
        
        .nav-pills .nav-link:hover:not(.active) {
            background-color: rgba(99, 102, 241, 0.08);
            color: var(--primary-color);
        }
        
        .profile-card {
            background: white;
            border-radius: 16px;
            box-shadow: var(--card-shadow);
            border: none;
            overflow: hidden;
            margin-bottom: 24px;
            transition: var(--transition);
        }
        
        .profile-card:hover {
            box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.15);
        }
        
        .profile-card-header {
            background: linear-gradient(to right, #f8fafc, #f1f5f9);
            padding: 20px 24px;
            border-bottom: 1px solid var(--border-color);
        }
        
        .profile-card-title {
            font-weight: 600;
            color: var(--text-primary);
            margin: 0;
            display: flex;
            align-items: center;
        }
        
        .form-control, .form-select {
            border-radius: 12px;
            padding: 12px 16px;
            border: 1px solid var(--border-color);
            transition: var(--transition);
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15);
        }
        
        .btn-primary {
            background: var(--primary-color);
            border: none;
            border-radius: 12px;
            padding: 12px 28px;
            font-weight: 500;
            transition: var(--transition);
        }
        
        .btn-primary:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(99, 102, 241, 0.3);
        }
        
        .btn-outline-primary {
            border-radius: 12px;
            padding: 10px 20px;
            font-weight: 500;
            transition: var(--transition);
        }
        
        .document-thumbnail {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: var(--transition);
        }
        
        .document-thumbnail:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }
        
        .modal-content {
            border-radius: 16px;
            border: none;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }
        
        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .tab-pane {
            animation: fadeIn 0.4s ease;
        }
        
        /* Asegurar que todas las pestañas tengan display block cuando son activas */
        .tab-pane {
            display: none;
        }
        
        .tab-pane.active {
            display: block;
            animation: fadeIn 0.4s ease;
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .profile-avatar {
                width: 100px;
                height: 100px;
            }
            
            .profile-header::before {
                height: 80px;
            }
        }
    </style>
</head>
<body>
    <div class="profile-container py-4">
        <!-- Header Section -->
        <div class="profile-header text-white p-4 p-md-5 position-relative">
            <div class="row align-items-center">
                <div class="col-md-8 d-flex align-items-center">
                    <div class="position-relative me-4">
                        <img src="{{ Auth::user()->foto_perfil 
                            ? asset('storage/' . Auth::user()->foto_perfil) 
                            : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&size=150&background=6366f1&color=fff' }}" 
                            class="profile-avatar" 
                            id="profileAvatar">
                        <button class="avatar-edit-btn" data-bs-toggle="modal" data-bs-target="#uploadLogoModal">
                            <i class="bi bi-camera text-primary"></i>
                        </button>
                    </div>
                    <div>
                        <h1 class="fw-bold mb-1">{{ Auth::user()->name }}</h1>
                        <p class="mb-2 opacity-90"><i class="bi bi-envelope me-2"></i>{{ Auth::user()->email }}</p>
                        <span class="profile-badge"><i class="bi bi-award me-1"></i>{{ Auth::user()->rol }}</span>
                    </div>
                </div>
                <div class="col-md-4 text-md-end mt-4 mt-md-0">
                    @if(Auth::user()->logo_personalizado)
                        <img src="{{ asset('storage/' . Auth::user()->logo_personalizado) }}" 
                            alt="Logo Personalizado" class="mb-3 img-fluid" style="max-height:45px;">
                    @endif
                    <br>
                    <button class="btn btn-light rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#uploadLogoModal">
                        <i class="bi bi-pencil me-1"></i> Cambiar Imagen
                    </button>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="row">
            <!-- Sidebar Navigation -->
            <div class="col-lg-3 mb-4">
                <div class="profile-card">
                    <div class="p-3">
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist">
                            <a class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">
                                <i class="bi bi-person-circle"></i> Información Personal
                            </a>
                            <a class="nav-link" id="v-pills-documentos-tab" data-bs-toggle="pill" href="#v-pills-documentos" role="tab" aria-controls="v-pills-documentos" aria-selected="false">
                                <i class="bi bi-file-earmark-text"></i> Documentos
                            </a>
                            <a class="nav-link" id="v-pills-security-tab" data-bs-toggle="pill" href="#v-pills-security" role="tab" aria-controls="v-pills-security" aria-selected="false">
                                <i class="bi bi-shield-lock"></i> Seguridad
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tab Content -->
            <div class="col-lg-9">
                <div class="tab-content" id="v-pills-tabContent">
                    
                    <!-- Personal Information Tab -->
                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                        <div class="profile-card">
                            <div class="profile-card-header">
                                <h5 class="profile-card-title">
                                    <i class="bi bi-person-circle text-primary me-2"></i> Información Personal
                                </h5>
                            </div>
                            <div class="card-body p-4">
                                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="row g-4">
                                        <div class="col-md-6">
                                            <label for="name" class="form-label fw-semibold">Nombre completo <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control shadow-sm" id="name" name="name" value="{{ old('name', Auth::user()->name) }}" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="email" class="form-label fw-semibold">Correo electrónico <span class="text-danger">*</span></label>
                                            <input type="email" class="form-control shadow-sm" id="email" name="email" value="{{ old('email', Auth::user()->email) }}" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="documento_identidad" class="form-label fw-semibold">Documento de identidad <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control shadow-sm" id="documento_identidad" name="documento_identidad" value="{{ old('documento_identidad', Auth::user()->documento_identidad) }}" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="fecha_nacimiento" class="form-label fw-semibold">Fecha de nacimiento</label>
                                            <input type="date" class="form-control shadow-sm" id="fecha_nacimiento" name="fecha_nacimiento" value="{{ old('fecha_nacimiento', Auth::user()->fecha_nacimiento) }}">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="telefono" class="form-label fw-semibold">Número de teléfono</label>
                                            <input type="tel" class="form-control shadow-sm" id="telefono" name="telefono" value="{{ old('telefono', Auth::user()->telefono) }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="eps" class="form-label fw-semibold">EPS</label>
                                            <select class="form-select shadow-sm" id="eps" name="eps">
                                                <option value="">Seleccione su EPS</option>
                                                @foreach(['Sura','Nueva EPS','Sanitas','Coomeva','Famisanar','Otro'] as $eps)
                                                    <option value="{{ $eps }}" {{ old('eps', Auth::user()->eps) == $eps ? 'selected' : '' }}>{{ $eps }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-12">
                                            <label for="direccion_hogar" class="form-label fw-semibold">Dirección de hogar</label>
                                            <textarea class="form-control shadow-sm" id="direccion_hogar" name="direccion_hogar" rows="3">{{ old('direccion_hogar', Auth::user()->direccion_hogar) }}</textarea>
                                        </div>
                                    </div>

                                    <div class="text-end mt-4">
                                        <button type="submit" class="btn btn-primary px-4 py-2">
                                            <i class="bi bi-check-circle me-1"></i> Actualizar información
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Documents Tab -->
                    <div class="tab-pane fade" id="v-pills-documentos" role="tabpanel" aria-labelledby="v-pills-documentos-tab">
                        <div class="profile-card">
                            <div class="profile-card-header">
                                <h5 class="profile-card-title">
                                    <i class="bi bi-file-earmark-text text-primary me-2"></i> Documentos
                                </h5>
                            </div>
                            <div class="card-body p-4">
                                <form action="{{ route('profile.uploadDocument') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-4">
                                        <label for="foto_documento" class="form-label fw-semibold">Foto del documento <span class="text-danger">*</span></label>
                                        <input type="file" class="form-control shadow-sm" id="foto_documento" name="foto_documento" accept="image/*">
                                        <div class="form-text text-muted mt-2">Suba una imagen clara de ambos lados de su documento de identidad.</div>
                                    </div>

                                    @if(Auth::user()->foto_documento)
                                        <div class="mt-4">
                                            <p class="fw-semibold mb-3">Documento actual:</p>
                                            <div class="document-thumbnail d-inline-block">
                                                <img src="{{ asset('storage/' . Auth::user()->foto_documento) }}" 
                                                    alt="Documento de identidad" class="img-fluid" style="max-height:200px;">
                                            </div>
                                        </div>
                                    @endif

                                    <div class="text-end mt-4">
                                        <button type="submit" class="btn btn-primary px-4 py-2">
                                            <i class="bi bi-cloud-upload me-1"></i> Subir documento
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Security Tab -->
                    <div class="tab-pane fade" id="v-pills-security" role="tabpanel" aria-labelledby="v-pills-security-tab">
                        <div class="profile-card">
                            <div class="profile-card-header">
                                <h5 class="profile-card-title">
                                    <i class="bi bi-shield-lock text-primary me-2"></i> Seguridad
                                </h5>
                            </div>
                            <div class="card-body p-4">
                                <form action="{{ route('profile.changePassword') }}" method="POST">
                                    @csrf
                                    <div class="mb-4">
                                        <label for="current_password" class="form-label fw-semibold">Contraseña actual</label>
                                        <input type="password" class="form-control shadow-sm" id="current_password" name="current_password">
                                    </div>
                                    <div class="mb-4">
                                        <label for="new_password" class="form-label fw-semibold">Nueva contraseña</label>
                                        <input type="password" class="form-control shadow-sm" id="new_password" name="new_password">
                                        <div class="form-text text-muted mt-2">Use al menos 8 caracteres con una combinación de letras, números y símbolos.</div>
                                    </div>
                                    <div class="mb-4">
                                        <label for="new_password_confirmation" class="form-label fw-semibold">Confirmar nueva contraseña</label>
                                        <input type="password" class="form-control shadow-sm" id="new_password_confirmation" name="new_password_confirmation">
                                    </div>
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-primary px-4 py-2">
                                            <i class="bi bi-key me-1"></i> Cambiar contraseña
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Image Upload -->
    <div class="modal fade" id="uploadLogoModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-camera me-2"></i>Cambiar foto de perfil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('perfilinst.uploadLogo') }}" method="POST" enctype="multipart/form-data" id="logoForm">
                        @csrf
                        <div class="mb-3">
                            <label for="logo" class="form-label fw-semibold">Seleccionar imagen</label>
                            <input class="form-control shadow-sm" type="file" id="logo" name="logo" accept="image/*">
                        </div>
                        @if(Auth::user()->foto_perfil)
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" id="removeProfileImage" name="remove_profile_image">
                                <label class="form-check-label text-danger fw-semibold" for="removeProfileImage">
                                    Eliminar imagen actual y usar avatar por defecto
                                </label>
                            </div>
                        @endif
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light rounded-pill px-3" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-3" form="logoForm">Guardar cambios</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap & Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    
    <script>
        // Image preview before upload
        document.getElementById('logo').addEventListener('change', function(e) {
            if (e.target.files && e.target.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('profileAvatar').src = e.target.result;
                }
                reader.readAsDataURL(e.target.files[0]);
            }
        });
        
        // Fix for tab switching issue
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize all tab panes with proper display
            const tabPanes = document.querySelectorAll('.tab-pane');
            tabPanes.forEach(pane => {
                pane.style.display = 'none';
            });
            
            // Show active pane
            const activePane = document.querySelector('.tab-pane.active');
            if (activePane) {
                activePane.style.display = 'block';
                activePane.style.opacity = 1;
                activePane.style.transform = 'translateY(0)';
            }
            
            // Handle tab changes
            const tabTriggers = document.querySelectorAll('[data-bs-toggle="pill"]');
            tabTriggers.forEach(trigger => {
                trigger.addEventListener('click', function(e) {
                    // Hide all panes
                    tabPanes.forEach(pane => {
                        pane.style.display = 'none';
                        pane.classList.remove('show', 'active');
                    });
                    
                    // Remove active class from all tabs
                    tabTriggers.forEach(tab => {
                        tab.classList.remove('active');
                    });
                    
                    // Add active class to clicked tab
                    this.classList.add('active');
                    
                    // Show the target pane
                    const targetId = this.getAttribute('href');
                    const targetPane = document.querySelector(targetId);
                    if (targetPane) {
                        targetPane.style.display = 'block';
                        setTimeout(() => {
                            targetPane.classList.add('show', 'active');
                            targetPane.style.opacity = 1;
                            targetPane.style.transform = 'translateY(0)';
                        }, 10);
                    }
                });
            });
            
            // Bootstrap tab event listener as backup
            const tabElements = document.querySelectorAll('a[data-bs-toggle="pill"]');
            tabElements.forEach(tab => {
                tab.addEventListener('shown.bs.tab', function (e) {
                    const targetPane = document.querySelector(e.target.getAttribute('data-bs-target'));
                    if (targetPane) {
                        targetPane.style.display = 'block';
                        targetPane.style.opacity = 1;
                        targetPane.style.transform = 'translateY(0)';
                    }
                });
            });
        });
    </script>

@endsection
