<!DOCTYPE html>
<html lang="en">

<head>
  <!-- CONFIGURACIÓN BÁSICA DEL DOCUMENTO -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- ETIQUETA META VIEWPORT PARA RESPONSIVIDAD -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <!-- HOJAS DE ESTILO -->
  <!-- Main CSS - Estilos principales de la aplicación -->
  <link rel="stylesheet" type="text/css" href="assets/css/main.css">
  <!-- Bootstrap Icons - Librería de iconos -->
  <link rel="stylesheet" type="text/css"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  
  <title>Proyecto sportzone</title>
  
  <style>
    /* ESTILOS PARA IMÁGENES DE PERFIL EN LA BARRA DE NAVEGACIÓN */
    .profile-image-nav {
      width: 40px;
      height: 40px;
      border-radius: 50%; /* Forma circular */
      object-fit: cover; /* Ajuste de imagen para cubrir el contenedor */
      border: 2px solid #fff; /* Borde blanco */
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Sombra suave */
    }

    /* ESTILOS PARA IMÁGENES DE PERFIL EN LA BARRA LATERAL (SIDEBAR) */
    .profile-image-sidebar {
      width: 60px; /* Más grande que en la navbar */
      height: 60px;
      border-radius: 50%;
      object-fit: cover;
      border: 2px solid #fff;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    /* AVATAR POR DEFECTO (cuando el usuario no tiene foto) */
    .default-avatar {
      display: flex;
      align-items: center;
      justify-content: center;
      background-color: #6c757d; /* Color gris */
      color: white;
      border-radius: 50%;
    }

    /* Tamaños específicos para navbar y sidebar */
    .default-avatar-nav {
      width: 40px;
      height: 40px;
    }

    .default-avatar-sidebar {
      width: 60px;
      height: 60px;
    }
  </style>
</head>

<body class="app sidebar-mini">
  <!-- NAVBAR/ENCABEZADO DE LA APLICACIÓN -->
  <header class="app-header">
    <!-- LOGO DE LA APLICACIÓN -->
    <a class="app-header__logo" href="index.html">
      <img src="{{ asset('assets/images/logo_sf.png') }}" alt="Logo" style="height: 65px; vertical-align: middle;">
    </a>
    
    <!-- BOTÓN PARA MOSTRAR/OCULTAR EL SIDEBAR (con clase no-loader para evitar el loader) -->
    <a class="app-sidebar__toggle no-loader" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
    
    <!-- MENU DE USUARIO EN LA PARTE DERECHA -->
    <ul class="navbar-nav ms-auto">
      <li class="nav-item dropdown">
        <!-- ENLACE DEL DROPDOWN DE USUARIO -->
        <a class="nav-link d-flex align-items-center" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown"
          aria-expanded="false">
          <!-- MUESTRA LA FOTO DE PERFIL O UN AVATAR POR DEFECTO -->
          @if(Auth::user()->foto_perfil && Storage::disk('public')->exists(Auth::user()->foto_perfil))
            <img src="{{ asset('storage/' . Auth::user()->foto_perfil) }}" alt="Foto de perfil"
              class="rounded-circle shadow-sm border profile-image-nav"
              style="width: 36px; height: 36px; object-fit: cover;">
          @else
            <div class="d-flex justify-content-center align-items-center rounded-circle bg-light text-secondary shadow-sm"
              style="width: 36px; height: 36px;">
              <i class="bi bi-person fs-5"></i> <!-- Icono de persona -->
            </div>
          @endif
          <!-- NOMBRE DEL USUARIO (oculto en dispositivos pequeños) -->
          <span class="ms-2 fw-semibold d-none d-md-inline">
            {{ Auth::user()->name }}
          </span>
          <!-- ÍCONO DE FLECHA HACIA ABAJO -->
          <i class="bi bi-caret-down-fill ms-1 small"></i>
        </a>

        <!-- MENÚ DESPLEGABLE DEL USUARIO -->
        <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 rounded-3 mt-2" aria-labelledby="userDropdown">
          <!-- OPCIÓN DE PERFIL -->
          <li>
            <a class="dropdown-item d-flex align-items-center" href="{{ route('profile.edit') }}">
              <i class="bi bi-person me-2 text-primary"></i> Perfil
            </a>
          </li>
          <li>
            <hr class="dropdown-divider"> <!-- Separador -->
          </li>
          <!-- OPCIÓN DE CERRAR SESIÓN -->
          <li>
            <a class="dropdown-item d-flex align-items-center text-danger no-loader" href="{{ route('logout') }}"
              onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <i class="bi bi-box-arrow-right me-2"></i> Cerrar sesión
            </a>
          </li>
          <!-- FORMULARIO OCULTO PARA CERRAR SESIÓN -->
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf <!-- Token de seguridad CSRF -->
          </form>
        </ul>
      </li>
    </ul>
  </header>

  <!-- OVERLAY PARA CERRAR EL SIDEBAR AL HACER CLIC FUERA -->
  <div class="app-sidebar__overlay" data-toggle="sidebar" id="sidebarOverlay"></div>
  
  <!-- BARRA LATERAL (SIDEBAR) -->
  <aside class="app-sidebar" id="sidebar">
    <!-- SECCIÓN DE INFORMACIÓN DEL USUARIO EN EL SIDEBAR -->
    <div class="app-sidebar__user">
      <div class="d-flex align-items-center">
        <!-- FOTO DE PERFIL O AVATAR POR DEFECTO -->
        @if(Auth::user()->foto_perfil && Storage::disk('public')->exists(Auth::user()->foto_perfil))
          <img src="{{ asset('storage/' . Auth::user()->foto_perfil) }}" alt="Foto de perfil"
            class="profile-image-sidebar me-3">
        @else
          <div class="default-avatar default-avatar-sidebar me-3">
            <i class="bi bi-person fs-4"></i> <!-- Icono de persona más grande -->
          </div>
        @endif
        <!-- INFORMACIÓN DEL USUARIO -->
        <div>
          <p class="mb-0 text-white fw-bold">{{ Auth::user()->name }}</p>
          <small class="text-white-50">Administrador</small> <!-- Rol del usuario -->
        </div>
      </div>
    </div>

    <!-- MENÚ DE NAVEGACIÓN PRINCIPAL -->
    <ul class="app-menu mt-3">
      <!-- ELEMENTO DEL MENÚ: INICIO -->
      <li>
        <a class="app-menu__item {{ request()->routeIs('admin.principal') ? 'active' : '' }}"
          href="{{ route('admin.dashboard') }}">
          <i class="bi bi-house-door"></i> <!-- Ícono de casa -->
          <span class="app-menu__label">Inicio</span>
        </a>
      </li>

      <!-- ELEMENTO DEL MENÚ: GESTIÓN DE USUARIOS -->
      <li>
        <a class="app-menu__item {{ request()->routeIs('usuario.index') ? 'active' : '' }}"
          href="{{ route('admin.gestion') }}">
          <i class="bi bi-people"></i> <!-- Ícono de personas -->
          <span class="app-menu__label">Gestión de Usuarios</span>
        </a>
      </li>
    </ul>
  </aside>
</body>