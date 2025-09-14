@extends('colaborador.reportes.layout')

@section('content')
    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3a0ca3;
            --success-color: #4cc9f0;
            --danger-color: #e5383b;
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
        }
        
        .card-header-modern {
            background: white;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            padding: 1.5rem;
            font-weight: 600;
            color: var(--primary-color);
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
        
        .btn-danger {
            background: linear-gradient(135deg, var(--danger-color), #c1121f);
            border: none;
        }
        
        .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(229, 56, 59, 0.4);
        }
        
        .btn-success {
            background: linear-gradient(135deg, #2ecc71, #27ae60);
            border: none;
        }
        
        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(46, 204, 113, 0.4);
        }
        
        .form-control, .form-select {
            border-radius: 12px;
            padding: 0.75rem 1rem;
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(67, 97, 238, 0.15);
        }
        
        .report-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            margin-bottom: 1rem;
            background-color: rgba(67, 97, 238, 0.1);
            color: var(--primary-color);
        }
        
        @media (max-width: 768px) {
            .app-title {
                padding: 1rem;
            }
            
            .btn-modern {
                width: 100%;
                margin-top: 0.5rem;
            }
            
            .d-flex.gap-2 {
                flex-direction: column;
            }
            
            .d-flex.gap-2 .btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
<main class="content">
    <div class="container py-5">
        <div class="app-container">
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
                    <div>
                        <h1 class="mb-1"><i class="bi bi-speedometer me-2"></i> Módulo de Reportes</h1>
                        <p class="mb-0">SportZone - Panel de generación de reportes</p>
                    </div>
                </div>
            </div>
            
            <!-- Reporte de Inscripciones -->
            <div class="card card-modern">
                <div class="card-header card-header-modern">
                    <h5 class="mb-0"><i class="bi bi-person-plus me-2"></i> Reporte de Inscripciones</h5>
                </div>
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-2 text-center">
                            <div class="report-icon">
                                <i class="bi bi-person-plus"></i>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <p class="mb-3">Genera un reporte en PDF con todas las inscripciones realizadas en un rango de fechas específico.</p>
                            <form action="{{ route('reportes.inscripciones') }}" method="GET" class="row g-3">
                                <div class="col-md-5">
                                    <label for="fecha_inicio" class="form-label">Fecha Inicio</label>
                                    <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
                                </div>
                                
                                <div class="col-md-5">
                                    <label for="fecha_fin" class="form-label">Fecha Fin</label>
                                    <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" required>
                                </div>
                                
                                <div class="col-md-2 align-self-end">
                                    <button type="submit" class="btn btn-primary btn-modern w-100">
                                        <i class="bi bi-file-earmark-pdf me-1"></i> Generar
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Reporte de Pagos -->
            <div class="card card-modern">
                <div class="card-header card-header-modern">
                    <h5 class="mb-0"><i class="bi bi-currency-dollar me-2"></i> Reporte de Pagos</h5>
                </div>
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-2 text-center">
                            <div class="report-icon" style="background-color: rgba(46, 204, 113, 0.1); color: #27ae60;">
                                <i class="bi bi-currency-dollar"></i>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <p class="mb-3">Genera reportes de pagos filtrados por tipo y fecha. Exporta en formato PDF o Excel.</p>
                            <form action="{{ route('reportes.pagos') }}" method="GET" class="row g-3">
                                <div class="col-md-3">
                                    <label for="tipo" class="form-label">Tipo de Pago</label>
                                    <select name="tipo" id="tipo" class="form-select">
                                        <option value="">Todos los tipos</option>
                                        <option value="inscripcion">Inscripción</option>
                                        <option value="mensualidad">Mensualidad</option>
                                    </select>
                                </div>
                                
                                <div class="col-md-3">
                                    <label for="fecha_inicio_p" class="form-label">Fecha Inicio</label>
                                    <input type="date" class="form-control" id="fecha_inicio_p" name="fecha_inicio">
                                </div>
                                
                                <div class="col-md-3">
                                    <label for="fecha_fin_p" class="form-label">Fecha Fin</label>
                                    <input type="date" class="form-control" id="fecha_fin_p" name="fecha_fin">
                                </div>
                                
                                <div class="col-md-3 align-self-end d-flex gap-2">
                                    <button type="submit" class="btn btn-danger btn-modern w-50">
                                        <i class="bi bi-file-earmark-pdf me-1"></i> PDF
                                    </button>
                                    <button type="button" id="btnExcel" class="btn btn-success btn-modern w-50">
                                        <i class="bi bi-file-earmark-excel me-1"></i> Excel
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Establecer fechas por defecto (mes actual)
        const today = new Date();
        const firstDayOfMonth = new Date(today.getFullYear(), today.getMonth(), 1);
        const lastDayOfMonth = new Date(today.getFullYear(), today.getMonth() + 1, 0);
        
        // Formatear fechas como YYYY-MM-DD
        function formatDate(date) {
            const year = date.getFullYear();
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const day = String(date.getDate()).padStart(2, '0');
            return `${year}-${month}-${day}`;
        }
        
        // Establecer valores por defecto para los campos de fecha
        document.getElementById('fecha_inicio').value = formatDate(firstDayOfMonth);
        document.getElementById('fecha_fin').value = formatDate(lastDayOfMonth);
        document.getElementById('fecha_inicio_p').value = formatDate(firstDayOfMonth);
        document.getElementById('fecha_fin_p').value = formatDate(lastDayOfMonth);
        
        // Función para exportación a Excel
        document.getElementById("btnExcel").addEventListener("click", function() {
            let tipo = document.getElementById("tipo").value;
            let inicio = document.getElementById("fecha_inicio_p").value;
            let fin = document.getElementById("fecha_fin_p").value;
            
            // Construir la URL para exportar a Excel
            let url = "{{ route('reportes.pagos.excel') }}" + "?tipo=" + tipo + "&fecha_inicio=" + inicio + "&fecha_fin=" + fin;
            window.location.href = url;
        });
    });
</script>
@endsection



