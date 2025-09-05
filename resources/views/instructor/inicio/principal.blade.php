@extends('instructor.inicio.layout')

@section('title', 'Panel de Control - Instructor')
@section('nav-message', 'Bienvenido - Panel de control de instructores')

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
            background: white;
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

        .btn-modern {
            border-radius: 50px;
            padding: 0.5rem 1rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-outline-primary {
            border-color: var(--primary-color);
            color: var(--primary-color);
        }

        .btn-outline-primary:hover {
            background-color: var(--primary-color);
            color: white;
        }

        .calendar-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)) !important;
            color: white !important;
        }

        .calendar-day {
            border-radius: 12px;
            transition: all 0.2s ease;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 2px;
        }

        .calendar-day:hover {
            background-color: rgba(67, 97, 238, 0.1);
        }

        .calendar-day.today {
            background-color: var(--primary-color);
            color: white;
            font-weight: bold;
        }

        .calendar-day.has-events {
            position: relative;
        }

        .calendar-day.has-events::after {
            content: '';
            position: absolute;
            bottom: 4px;
            left: 50%;
            transform: translateX(-50%);
            width: 6px;
            height: 6px;
            background-color: var(--primary-color);
            border-radius: 50%;
        }

        .notification-item {
            border-left: 4px solid var(--primary-color);
            transition: all 0.3s ease;
        }

        .notification-item:hover {
            background-color: #f8f9fa;
            transform: translateX(5px);
        }

        .stats-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: var(--card-shadow);
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

        @media (max-width: 768px) {
            .app-container {
                padding: 0 15px;
            }
        }
    </style>

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
                        <h1 class="mb-1"><i class="bi bi-clipboard-check me-2"></i> Control de Actividades</h1>
                        <p class="mb-0">Bienvenido/a, {{ Auth::user()->name }}</p>
                    </div>
                </div>
            </div>
            {{-- Tarjetas de estadísticas --}}
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="stats-card">
                        <div class="stats-icon"
                            style="background-color: rgba(67, 97, 238, 0.1); color: var(--primary-color);">
                            <i class="bi bi-calendar-check"></i>
                        </div>
                        <h3>{{ $clasesActivas }}</h3>
                        <p class="text-muted">Clases Activas</p>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="stats-card">
                        <div class="stats-icon" style="background-color: rgba(46, 204, 113, 0.1); color: #27ae60;">
                            <i class="bi bi-people-fill"></i>
                        </div>
                        <h3>{{ $totalInstructores }}</h3>
                        <p class="text-muted">Total Instructores</p>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="stats-card">
                        <div class="stats-icon" style="background-color: rgba(247, 183, 49, 0.1); color: #f39c12;">
                            <i class="bi bi-clock-history"></i>
                        </div>
                        <h3>{{ $clasesPendientes }}</h3>
                        <p class="text-muted">Clases Pendientes</p>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="stats-card">
                        <div class="stats-icon" style="background-color: rgba(235, 87, 87, 0.1); color: #e74c3c;">
                            <i class="bi bi-x-circle"></i>
                        </div>
                        <h3>{{ $clasesCanceladas }}</h3>
                        <p class="text-muted">Clases Canceladas</p>
                    </div>
                </div>
            </div>


            <div class="row mb-4">
                {{-- Calendario --}}
                <div class="col-lg-8 mb-4">
                    <div class="card card-modern">
                        <div class="card-header card-header-modern d-flex justify-content-between align-items-center">
                            <h5 class="mb-0"><i class="bi bi-calendar-event me-2"></i> Calendario de Actividades</h5>
                            <div>
                                <button class="btn btn-sm btn-outline-primary me-1" id="prevMonth">
                                    <i class="bi bi-chevron-left"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-primary" id="nextMonth">
                                    <i class="bi bi-chevron-right"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <input type="month" class="form-control" id="monthSelector">
                            </div>
                            <div class="mini-calendar">
                                <div class="calendar-header d-flex justify-content-between py-2 rounded-top">
                                    <div class="text-center" style="width: 14.28%;">Lun</div>
                                    <div class="text-center" style="width: 14.28%;">Mar</div>
                                    <div class="text-center" style="width: 14.28%;">Mié</div>
                                    <div class="text-center" style="width: 14.28%;">Jue</div>
                                    <div class="text-center" style="width: 14.28%;">Vie</div>
                                    <div class="text-center" style="width: 14.28%;">Sáb</div>
                                    <div class="text-center" style="width: 14.28%;">Dom</div>
                                </div>
                                <div class="calendar-body" id="calendarBody">
                                    <!-- El calendario se generará con JavaScript -->
                                </div>
                            </div>
                            <div class="mt-4" id="dailyEvents">
                                <h5 class="mb-3">Actividades para hoy</h5>
                                <div class="list-group">
                                    <p class="text-muted text-center p-3 mb-0">
                                        Selecciona una fecha en el calendario para ver o agregar actividades.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Imagen --}}
                <div class="col-lg-4">
                    <div class="card card-modern h-100">
                        <div class="card-header card-header-modern">
                            <h5 class="mb-0"><i class="bi bi-image me-2"></i> SportZone</h5>
                        </div>
                        <div class="card-body p-0">
                            <img src="{{ asset('assets/images/imagen.jpg') }}" alt="Deportes"
                                class="img-fluid rounded-bottom" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                    </div>
                </div>
            </div>

            {{-- Notificaciones --}}
            <div class="row">
                <div class="col-12">
                    <div class="card card-modern">
                        <div class="card-header card-header-modern">
                            <h5 class="mb-0"><i class="bi bi-bell me-2"></i> Últimas notificaciones</h5>
                        </div>
                        <div class="card-body">
                            <div class="list-group" id="notificationList">
                                @forelse ($asistenciasHoy as $asistencia)
                                    <div class="list-group-item notification-item">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h6 class="mb-1">Asistencia registrada</h6>
                                            <small
                                                class="text-muted">{{ \Carbon\Carbon::parse($asistencia->fecha)->format('d/m/Y H:i') }}</small>
                                        </div>
                                        <p class="mb-1">Estudiante: <strong>{{ $asistencia->estudiante->nombre_1 }}
                                                {{ $asistencia->estudiante->apellido_1 }}</strong></p>
                                        <p class="mb-1">Subgrupo: <strong>{{ $asistencia->subgrupo->nombre ?? 'N/A' }}</strong>
                                        </p>
                                        <small class="text-muted">Estado:
                                            <span
                                                class="badge {{ $asistencia->estado == 'asistió' ? 'bg-success' : 'bg-danger' }}">
                                                {{ $asistencia->estado }}
                                            </span>
                                        </small>
                                    </div>
                                @empty
                                    <div class="text-center py-4">
                                        <i class="bi bi-check-circle display-4 text-muted"></i>
                                        <p class="mt-3">No hay asistencias registradas para hoy</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Footer --}}
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="card card-modern">
                        <div class="card-body">
                            <h5>SportZone</h5>
                            <p class="text-muted">Sistema de gestión para escuelas deportivas</p>
                            <div class="d-flex">
                                <a href="#" class="me-3 text-primary"><i class="bi bi-facebook"></i></a>
                                <a href="#" class="me-3 text-primary"><i class="bi bi-instagram"></i></a>
                                <a href="#" class="me-3 text-primary"><i class="bi bi-twitter"></i></a>
                                <a href="#" class="text-primary"><i class="bi bi-youtube"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-modern">
                        <div class="card-body">
                            <h5>Contacto</h5>
                            <p class="text-muted mb-2">
                                <i class="bi bi-envelope me-2"></i> info@sportzone.edu
                            </p>
                            <p class="text-muted mb-2">
                                <i class="bi bi-telephone me-2"></i> +57 123 456 7890
                            </p>
                            <p class="text-muted mb-0">v1.0.0</p>
                            <p class="text-muted">© {{ date('Y') }} Todos los derechos reservados</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Incluir Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

    <!-- Scripts -->
    <script src="{{ asset('assets/js/calendar.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="app.js"></script>

@endsection