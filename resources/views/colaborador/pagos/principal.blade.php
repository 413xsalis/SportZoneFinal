@extends('colaborador.pagos.partials.layout')

@section('contenido')
    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3a0ca3;
            --success-color: #2ecc71;
            --warning-color: #f39c12;
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
            max-width: 1000px;
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
        
        .card-modern {
            border: none;
            border-radius: 16px;
            box-shadow: var(--card-shadow);
            transition: all 0.3s ease;
            overflow: hidden;
            margin-bottom: 2rem;
        }
        
        .card-modern:hover {
            box-shadow: var(--hover-shadow);
            transform: translateY(-5px);
        }
        
        .option-card {
            height: 100%;
            border-radius: 16px;
            padding: 2rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: all 0.3s ease;
            border: none;
            background: white;
        }
        
        .option-card:hover {
            box-shadow: var(--hover-shadow);
        }
        
        .option-icon {
            width: 70px;
            height: 70px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            margin-bottom: 1.5rem;
        }
        
        .inscripciones-icon {
            background-color: rgba(46, 204, 113, 0.1);
            color: var(--success-color);
        }
        
        .mensualidades-icon {
            background-color: rgba(243, 156, 18, 0.1);
            color: var(--warning-color);
        }
        
        .btn-modern {
            border-radius: 50px;
            padding: 0.5rem 1.5rem;
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
        
        .card-link {
            text-decoration: none;
            color: inherit;
        }
        
        .card-link:hover {
            color: inherit;
        }
        
        @media (max-width: 768px) {
            .app-title {
                padding: 1rem;
            }
            
            .option-card {
                padding: 1.5rem;
            }
            
            .option-icon {
                width: 60px;
                height: 60px;
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
<main class="content">
    <div class="container py-5">
        <div class="app-container">
            <!-- Encabezado mejorado -->
            <div class="app-title">
                <div class="d-flex align-items-center">
                                      @if(Auth::user()->foto_perfil && Storage::disk('public')->exists(Auth::user()->foto_perfil))
                        <img src="{{ asset('storage/' . Auth::user()->foto_perfil) }}" alt="Foto de perfil"
                            class="profile-image-sidebar me-3">
                    @else
                        <div class="default-avatar-sidebar me-3">
                            <i class="bi bi-person fs-4"></i>
                        </div>
                    @endif
                    <div class="me-3">
                        <i class="bi bi-currency-exchange fs-1"></i>
                    </div>
                    <div>
                        <h1 class="mb-1"><i class="bi bi-people me-2"></i> Módulo de Pagos</h1>
                        <p class="mb-0">SportZone - Gestión de pagos de inscripciones y mensualidades</p>
                    </div>
                </div>
            </div>
            
            <!-- Tarjetas de opciones -->
            <div class="row">
                <div class="col-md-6 mb-4">
                    <a href="{{ route('pagos.inscripciones.index') }}" class="card-link">
                        <div class="card-modern">
                            <div class="option-card">
                                <div>
                                    <div class="option-icon inscripciones-icon">
                                        <i class="bi bi-person-plus-fill"></i>
                                    </div>
                                    <h3 class="mb-3">Inscripciones</h3>
                                    <p class="text-muted">Gestiona los pagos de inscripción de nuevos clientes. Registra, consulta y actualiza la información de inscripciones.</p>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mt-4">
                                    <span class="badge bg-success">Activo</span>
                                    <div class="d-flex align-items-center text-primary">
                                        <span class="me-2">Acceder</span>
                                        <i class="bi bi-arrow-right-circle-fill"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                
                <div class="col-md-6 mb-4">
                    <a href="{{ route('pagos.mensualidades.index') }}" class="card-link">
                        <div class="card-modern">
                            <div class="option-card">
                                <div>
                                    <div class="option-icon mensualidades-icon">
                                        <i class="bi bi-calendar-check-fill"></i>
                                    </div>
                                    <h3 class="mb-3">Mensualidades</h3>
                                    <p class="text-muted">Administra los pagos mensuales de los clientes. Consulta estados de cuenta, registra pagos y genera recordatorios.</p>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mt-4">
                                    <span class="badge bg-success">Activo</span>
                                    <div class="d-flex align-items-center text-primary">
                                        <span class="me-2">Acceder</span>
                                        <i class="bi bi-arrow-right-circle-fill"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Aquí puedes agregar cualquier funcionalidad JavaScript que necesites
        console.log('Página de gestión de pagos cargada');
        
        // Ejemplo: Efecto de hover mejorado para las tarjetas
        const cards = document.querySelectorAll('.card-modern');
        cards.forEach(card => {
            card.addEventListener('mouseenter', () => {
                card.style.transform = 'translateY(-5px)';
            });
            
            card.addEventListener('mouseleave', () => {
                card.style.transform = 'translateY(0)';
            });
        });
    });
</script>
@endsection