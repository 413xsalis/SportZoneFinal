@extends('instructor.asistencia.layout')
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
      max-width: 1200px;
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

    .profile-image-sidebar {
      width: 60px;
      height: 60px;
      border-radius: 50%;
      object-fit: cover;
      border: 3px solid rgba(255, 255, 255, 0.3);
    }

    .default-avatar-sidebar {
      width: 60px;
      height: 60px;
      border-radius: 50%;
      background-color: rgba(255, 255, 255, 0.2);
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      border: 3px solid rgba(255, 255, 255, 0.3);
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
      transform: translateY(-5px);
    }

    .card-header-modern {
      background: white;
      border-bottom: 1px solid rgba(0, 0, 0, 0.05);
      padding: 1.5rem;
    }

    .btn-modern {
      border-radius: 50px;
      padding: 0.5rem 1.5rem;
      font-weight: 500;
      transition: all 0.3s ease;
    }

    .btn-success {
      background: linear-gradient(135deg, #2ecc71, #27ae60);
      border: none;
    }

    .btn-success:hover {
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(46, 204, 113, 0.4);
    }

    .empty-state {
      text-align: center;
      padding: 3rem;
      color: #6c757d;
    }

    .empty-state i {
      font-size: 5rem;
      margin-bottom: 1.5rem;
      color: #dee2e6;
    }

    .group-card {
      border-radius: 12px;
      overflow: hidden;
      transition: all 0.3s ease;
      border: none;
      box-shadow: var(--card-shadow);
    }

    .group-card:hover {
      transform: translateY(-5px);
      box-shadow: var(--hover-shadow);
    }

    .group-card-header {
      background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
      color: white;
      padding: 1rem;
      text-align: center;
      font-weight: 600;
    }

    .group-card-body {
      padding: 1.5rem;
      text-align: center;
    }

    .group-icon {
      font-size: 2.5rem;
      margin-bottom: 1rem;
      color: var(--primary-color);
    }

    .stats-card {
      background: white;
      border-radius: 12px;
      padding: 1.5rem;
      box-shadow: var(--card-shadow);
      margin-bottom: 1.5rem;
      transition: all 0.3s ease;
    }

    .stats-card:hover {
      transform: translateY(-5px);
      box-shadow: var(--hover-shadow);
    }

    .stats-icon {
      width: 50px;
      height: 50px;
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.5rem;
      margin-bottom: 1rem;
    }

    footer {
      background: white;
      border-radius: 16px;
      padding: 2rem;
      margin-top: 3rem;
      box-shadow: var(--card-shadow);
    }

    .social-icon {
      width: 36px;
      height: 36px;
      border-radius: 50%;
      background-color: #f8f9fa;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      margin-right: 0.5rem;
      transition: all 0.3s ease;
    }

    .social-icon:hover {
      background-color: var(--primary-color);
      color: white;
      transform: translateY(-3px);
    }

    @media (max-width: 768px) {
      .app-title {
        padding: 1rem;
      }

      .card-header-modern {
        flex-direction: column;
      }
    }
  </style>
  </head>

  <body>
    <main class="content py-5">
      <div class="app-container">
        <!-- Encabezado con información de usuario -->
        <div class="app-title">
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
              <h1 class="mb-1"><i class="bi bi-clipboard-check me-2"></i> Control de Asistencia</h1>
              <p class="mb-0">Bienvenido/a, {{ Auth::user()->name }}</p>
            </div>
          </div>
        </div>

        <!-- Contenido principal -->
        <div class="card card-modern">
          <div class="card-header card-header-modern">
            <h5 class="mb-0"><i class="bi bi-grid me-2"></i> Selecciona un grupo para tomar asistencia</h5>
          </div>
          <div class="card-body">
            @if(isset($grupos) && count($grupos) > 0)
              <div class="row">
                @foreach($grupos as $grupo)
                  <div class="col-md-4 mb-4">
                    <div class="group-card">
                      <div class="group-card-header">
                        {{ $grupo->nombre }}
                      </div>
                      <div class="group-card-body">
                        <div class="group-icon">
                          <i class="bi bi-people-fill"></i>
                        </div>
                        <a href="{{ route('asistencia.subgrupos', ['grupo_id' => $grupo->id]) }}"
                          class="btn btn-success btn-modern">
                          <i class="bi bi-clipboard-check me-2"></i> Tomar asistencia
                        </a>
                      </div>
                    </div>
                  </div>
                @endforeach
              </div>
            @else
              <div class="empty-state">
                <i class="bi bi-inbox"></i>
                <h3>No hay grupos disponibles</h3>
                <p>Actualmente no tienes grupos asignados para tomar asistencia.</p>
              </div>
            @endif
          </div>
        </div>

        <!-- Pie de página -->
        <footer>
          <div class="row">
            <div class="col-md-6">
              <h5>SportZone</h5>
              <p class="text-muted">Sistema de gestión para escuelas deportivas</p>
              <div class="d-flex">
                <a href="#" class="social-icon text-muted"><i class="bi bi-facebook"></i></a>
                <a href="#" class="social-icon text-muted"><i class="bi bi-instagram"></i></a>
                <a href="#" class="social-icon text-muted"><i class="bi bi-twitter"></i></a>
                <a href="#" class="social-icon text-muted"><i class="bi bi-youtube"></i></a>
              </div>
            </div>
            <div class="col-md-6 text-md-end">
              <h5>Contacto</h5>
              <p class="text-muted mb-0">
                <i class="bi bi-envelope me-2"></i> info@sportzone.edu
              </p>
              <p class="text-muted mb-0">
                <i class="bi bi-telephone me-2"></i> +57 123 456 7890
              </p>
              <p class="text-muted mb-0">v1.0.0</p>
              <p class="text-muted">© {{ date('Y') }} Todos los derechos reservados</p>
            </div>
          </div>
        </footer>
      </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/calendar.js') }}"></script> 

    <script>
      // Efecto de carga inicial para las tarjetas
      document.addEventListener('DOMContentLoaded', function () {
        const cards = document.querySelectorAll('.group-card');
        cards.forEach((card, index) => {
          card.style.opacity = '0';
          card.style.transform = 'translateY(20px)';
          setTimeout(() => {
            card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
          }, 100 * index);
        });
      });
    </script>
@endsection
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="app.js"></script>