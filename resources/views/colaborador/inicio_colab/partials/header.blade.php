<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Main CSS-->
  <link rel="stylesheet" type="text/css" href="assets/css/main.css">
  <!-- Font-icon css-->
  <link rel="stylesheet" type="text/css"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <title>Proyecto sportzone</title>
  <style>
    .profile-image-nav {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      object-fit: cover;
      border: 2px solid #fff;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .profile-image-sidebar {
      width: 60px;
      height: 60px;
      border-radius: 50%;
      object-fit: cover;
      border: 2px solid #fff;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .default-avatar {
      display: flex;
      align-items: center;
      justify-content: center;
      background-color: #6c757d;
      color: white;
      border-radius: 50%;
    }

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
  <!-- Navbar-->
  <header class="app-header">
    <a class="app-header__logo" href="index.html">
      <img src="{{ asset('assets/images/logo_sf.png') }}" alt="Logo" style="height: 65px; vertical-align: middle;">
    </a>
    <a class="app-sidebar__toggle no-loader" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
    <!-- Navbar Right Menu-->
    <ul class="navbar-nav ms-auto">
  <li class="nav-item dropdown">
    <a class="nav-link d-flex align-items-center" href="#" id="userDropdown" role="button"
       data-bs-toggle="dropdown" aria-expanded="false">
      @if(Auth::user()->foto_perfil && Storage::disk('public')->exists(Auth::user()->foto_perfil))
        <img src="{{ asset('storage/' . Auth::user()->foto_perfil) }}" 
             alt="Foto de perfil" 
             class="rounded-circle shadow-sm border profile-image-nav"
             style="width: 36px; height: 36px; object-fit: cover;">
      @else
        <div class="d-flex justify-content-center align-items-center rounded-circle bg-light text-secondary shadow-sm"
             style="width: 36px; height: 36px;">
          <i class="bi bi-person fs-5"></i>
        </div>
      @endif
      <span class="ms-2 fw-semibold d-none d-md-inline">
        {{ Auth::user()->name }}
      </span>
      <i class="bi bi-caret-down-fill ms-1 small"></i>
    </a>

    <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 rounded-3 mt-2"
        aria-labelledby="userDropdown">
      <li>
        <a class="dropdown-item d-flex align-items-center" href="{{ route('perfilcolab.edit') }}">
          <i class="bi bi-person me-2 text-primary"></i> Perfil
        </a>
      </li>
      <li><hr class="dropdown-divider"></li>
      <li>
        <a class="dropdown-item d-flex align-items-center text-danger no-loader" href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
          <i class="bi bi-box-arrow-right me-2"></i> Cerrar sesión
        </a>
      </li>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
      </form>
    </ul>
  </li>
</ul>
  </header>

  <!-- Sidebar menu-->
  <div class="app-sidebar__overlay" data-toggle="sidebar" id="sidebarOverlay"></div>
  <aside class="app-sidebar" id="sidebar">
    <div class="app-sidebar__user">
      <div class="d-flex align-items-center">
        @if(Auth::user()->foto_perfil && Storage::disk('public')->exists(Auth::user()->foto_perfil))
          <img src="{{ asset('storage/' . Auth::user()->foto_perfil) }}" alt="Foto de perfil"
            class="profile-image-sidebar me-3">
        @else
          <div class="default-avatar default-avatar-sidebar me-3">
            <i class="bi bi-person fs-4"></i>
          </div>
        @endif
        <div>
          <p class="mb-0 text-white fw-bold">{{ Auth::user()->name }}</p>
          <small class="text-white-50">Colaborador</small>
        </div>
      </div>
    </div>
    <!-- Sidebar menu-->

    <ul class="app-menu">
      <a class="app-menu__item" href="{{ route('colaborador.dashboard') }}">
        <i class="bi bi-journal-bookmark me-2"></i>
        <span class="app-menu__label">Inicio</span>
      </a>
      <ul class="app-menu">
        <a class="app-menu__item" href="{{ route('colaborador.gestion') }}">
          <i class="bi bi-journal-bookmark me-2"></i>
          <span class="app-menu__label">Gestion de clases</span>
        </a>

        <a class="app-menu__item" href="{{route('colaborador.inscripcion')}}">
          <i class="bi bi-person-plus me-2"></i>
          <span class="app-menu__label">Inscripcíon de Estudiantes</span>
        </a>

        <a class="app-menu__item" href="{{ route('pagos.dashboard') }}">
          <i class="bi bi-cash-coin me-2"></i>
          <span class="app-menu__label">Pagos</span>
        </a>

        <a class="app-menu__item" href="{{ route('colaborador.reportes') }}">
          <i class="bi bi-bar-chart-line me-2"></i>
          <span class="app-menu__label">Reportes</span>
        </a>

      </ul>

  </aside>