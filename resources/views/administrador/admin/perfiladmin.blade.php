@extends('administrador.admin.layout')

@section('title', 'Perfil de Usuario')

@section('content')
<main class="content">
    <div class="container-fluid">
        <!-- Header con info -->
        <div class="card shadow-sm border-0 mb-4 rounded-3">
            <div class="card-body">
                <div class="row align-items-center">
                    <!-- Avatar -->
                    <div class="col-md-2 text-center">
                        <div class="position-relative d-inline-block">
                            <img src="{{ Auth::user()->foto_perfil 
                                ? asset('storage/' . Auth::user()->foto_perfil) 
                                : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&size=150&background=random' }}" 
                                class="rounded-circle shadow" 
                                id="profileAvatar" 
                                style="width:120px; height:120px; object-fit:cover;">

                            <button class="btn btn-sm btn-light position-absolute bottom-0 end-0 shadow-sm rounded-circle" 
                                    data-bs-toggle="modal" data-bs-target="#uploadLogoModal">
                                <i class="bi bi-camera-fill"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Info usuario -->
                    <div class="col-md-7">
                        <h2 class="fw-bold mb-1">{{ Auth::user()->name }}</h2>
                        <p class="mb-1 text-muted"><i class="bi bi-envelope me-2"></i>{{ Auth::user()->email }}</p>
                        <span class="badge bg-primary"><i class="bi bi-tag me-1"></i>{{ Auth::user()->rol }}</span>
                    </div>

                    <!-- Logo personalizado -->
                    <div class="col-md-3 text-md-end mt-3 mt-md-0">
                        @if(Auth::user()->logo_personalizado)
                            <img src="{{ asset('storage/' . Auth::user()->logo_personalizado) }}" 
                                alt="Logo Personalizado" class="mb-2 img-fluid" style="max-height:40px;">
                        @endif
                        <br>
                        <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#uploadLogoModal">
                            <i class="bi bi-pencil-square me-1"></i> Cambiar Imagen
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabs layout -->
        <div class="row">
            <!-- Sidebar tabs -->
            <div class="col-lg-3 mb-3">
                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-body p-0">
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist">
                            <a class="nav-link active d-flex align-items-center py-3 px-3 border-bottom" 
                               id="v-pills-home-tab" data-bs-toggle="pill" href="#v-pills-home" role="tab">
                                <i class="bi bi-person-circle me-2 text-primary"></i> Información Personal
                            </a>
                            <a class="nav-link d-flex align-items-center py-3 px-3 border-bottom" 
                               id="v-pills-documentos-tab" data-bs-toggle="pill" href="#v-pills-documentos" role="tab">
                                <i class="bi bi-id-card me-2 text-primary"></i> Documentos
                            </a>
                            <a class="nav-link d-flex align-items-center py-3 px-3" 
                               id="v-pills-security-tab" data-bs-toggle="pill" href="#v-pills-security" role="tab">
                                <i class="bi bi-lock me-2 text-primary"></i> Seguridad
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tab content -->
            <div class="col-lg-9">
                <div class="tab-content" id="v-pills-tabContent">
                    
                    <!-- Información Personal -->
                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel">
                        <div class="card shadow-sm border-0 rounded-3">
                            <div class="card-header bg-light">
                                <h5 class="mb-0 fw-semibold"><i class="bi bi-person-circle me-2 text-primary"></i> Información Personal</h5>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label for="name" class="form-label">Nombre completo <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', Auth::user()->name) }}" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="email" class="form-label">Correo electrónico <span class="text-danger">*</span></label>
                                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', Auth::user()->email) }}" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="documento_identidad" class="form-label">Documento de identidad <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="documento_identidad" name="documento_identidad" value="{{ old('documento_identidad', Auth::user()->documento_identidad) }}" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento</label>
                                            <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" value="{{ old('fecha_nacimiento', Auth::user()->fecha_nacimiento) }}">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="telefono" class="form-label">Número de teléfono</label>
                                            <input type="tel" class="form-control" id="telefono" name="telefono" value="{{ old('telefono', Auth::user()->telefono) }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="eps" class="form-label">EPS</label>
                                            <select class="form-select" id="eps" name="eps">
                                                <option value="">Seleccione su EPS</option>
                                                @foreach(['Sura','Nueva EPS','Sanitas','Coomeva','Famisanar','Otro'] as $eps)
                                                    <option value="{{ $eps }}" {{ old('eps', Auth::user()->eps) == $eps ? 'selected' : '' }}>{{ $eps }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-12">
                                            <label for="direccion_hogar" class="form-label">Dirección de hogar</label>
                                            <textarea class="form-control" id="direccion_hogar" name="direccion_hogar" rows="3">{{ old('direccion_hogar', Auth::user()->direccion_hogar) }}</textarea>
                                        </div>
                                    </div>

                                    <div class="text-end mt-4">
                                        <button type="submit" class="btn btn-primary px-4">Actualizar información</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Documentos -->
                    <div class="tab-pane fade" id="v-pills-documentos" role="tabpanel">
                        <div class="card shadow-sm border-0 rounded-3">
                            <div class="card-header bg-light">
                                <h5 class="mb-0 fw-semibold"><i class="bi bi-id-card me-2 text-primary"></i> Documentos</h5>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('profile.uploadDocument') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="foto_documento" class="form-label">Foto del documento <span class="text-danger">*</span></label>
                                        <input type="file" class="form-control" id="foto_documento" name="foto_documento" accept="image/*">
                                        <div class="form-text">Suba una imagen clara de ambos lados.</div>
                                    </div>

                                    @if(Auth::user()->foto_documento)
                                        <div class="mt-3">
                                            <p class="fw-semibold">Documento actual:</p>
                                            <img src="{{ asset('storage/' . Auth::user()->foto_documento) }}" alt="Documento de identidad" class="img-thumbnail shadow-sm" style="max-height:200px;">
                                        </div>
                                    @endif

                                    <div class="text-end mt-4">
                                        <button type="submit" class="btn btn-primary px-4">Subir documento</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Seguridad -->
                    <div class="tab-pane fade" id="v-pills-security" role="tabpanel">
                        <div class="card shadow-sm border-0 rounded-3">
                            <div class="card-header bg-light">
                                <h5 class="mb-0 fw-semibold"><i class="bi bi-lock me-2 text-primary"></i> Seguridad</h5>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('profile.changePassword') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="current_password" class="form-label">Contraseña actual</label>
                                        <input type="password" class="form-control" id="current_password" name="current_password">
                                    </div>
                                    <div class="mb-3">
                                        <label for="new_password" class="form-label">Nueva contraseña</label>
                                        <input type="password" class="form-control" id="new_password" name="new_password">
                                    </div>
                                    <div class="mb-3">
                                        <label for="new_password_confirmation" class="form-label">Confirmar nueva contraseña</label>
                                        <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation">
                                    </div>
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-primary px-4">Cambiar contraseña</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Modal para subir foto -->
<div class="modal fade" id="uploadLogoModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg rounded-3">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-camera me-2"></i>Cambiar foto de perfil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('perfilinst.uploadLogo') }}" method="POST" enctype="multipart/form-data" id="logoForm">
                    @csrf
                    <div class="mb-3">
                        <label for="logo" class="form-label">Seleccionar imagen</label>
                        <input class="form-control" type="file" id="logo" name="logo" accept="image/*">
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
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary" form="logoForm">Guardar cambios</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Preview de imagen antes de subirla
    document.getElementById('logo').addEventListener('change', function(e) {
        if (e.target.files && e.target.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('profileAvatar').src = e.target.result;
            }
            reader.readAsDataURL(e.target.files[0]);
        }
    });
</script>
@endsection
