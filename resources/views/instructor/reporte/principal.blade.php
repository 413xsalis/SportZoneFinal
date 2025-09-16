@extends('instructor.reporte.layout')

@section('nav-message')
    Bienvenido - Panel de control de instructores
@endsection

@section('content')
    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3a0ca3;
            --info-color: #4cc9f0;
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

        .card-modern {
            border: none;
            border-radius: 16px;
            box-shadow: var(--card-shadow);
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .card-modern:hover {
            box-shadow: var(--hover-shadow);
        }

        .card-header-modern {
            background: white;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            padding: 1.5rem;
        }

        .form-select-modern,
        .form-control-modern {
            border-radius: 12px;
            padding: 0.75rem 1rem;
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
        }

        .form-select-modern:focus,
        .form-control-modern:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(67, 97, 238, 0.15);
        }

        .btn-modern {
            border-radius: 50px;
            padding: 0.75rem 1.5rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-info {
            background: linear-gradient(135deg, var(--info-color), #3a86ff);
            border: none;
            color: white;
        }

        .btn-info:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(76, 201, 240, 0.4);
            color: white;
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

        .filter-section {
            background: white;
            border-radius: 16px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            box-shadow: var(--card-shadow);
        }

        .table-modern {
            border-collapse: separate;
            border-spacing: 0;
            width: 100%;
        }

        .table-modern th {
            background-color: #f8f9fa;
            border-top: 1px solid #dee2e6;
            font-weight: 600;
            padding: 1rem;
            color: #495057;
        }

        .table-modern td {
            padding: 1rem;
            vertical-align: middle;
            border-top: 1px solid #f1f3f4;
        }

        .table-modern tr {
            transition: all 0.2s ease;
        }

        .table-modern tr:hover {
            background-color: rgba(67, 97, 238, 0.03);
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.03);
        }

        .badge-modern {
            padding: 0.5em 0.8em;
            border-radius: 50px;
            font-weight: 500;
            font-size: 0.85em;
        }

        @media (max-width: 768px) {
            .app-title {
                padding: 1rem;
            }

            .filter-section {
                padding: 1rem;
            }
        }
    </style>

    <main class="content">
        <div class="container py-5">
            <div class="app-container">
                <!-- Encabezado con información de usuario -->
                <div class="app-title">
                    <div class="d-flex align-items-center">
                        <div>
                            <h1 class="mb-4"><i class="bi bi-clipboard-check me-2"></i> Reportes</h1>
                            <p class="mb-0">Bienvenido/a, {{ Auth::user()->name }}</p>
                        </div>
                    </div>
                </div>



                <!-- Filtros -->
                <div class="filter-section">
                    <h5 class="mb-3"><i class="bi bi-funnel me-2"></i> Filtros de Reporte</h5>
                    <form method="GET" action="{{ route('instructor.reporte.asistencias') }}">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label for="grupo_id" class="form-label">Grupo</label>
                                <select name="grupo_id" id="grupo_id" class="form-select form-select-modern" required>
                                    <option value="">Seleccione un grupo...</option>
                                    @foreach($grupos as $grupo)
                                        <option value="{{ $grupo->id }}" {{ request('grupo_id') == $grupo->id ? 'selected' : '' }}>{{ $grupo->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="subgrupo_id" class="form-label">Subgrupo</label>
                                <select name="subgrupo_id" id="subgrupo_id" class="form-select form-select-modern" required>
                                    <option value="">Seleccione un subgrupo...</option>
                                    @if(request('grupo_id'))
                                        @foreach(\App\Models\Subgrupo::where('grupo_id', request('grupo_id'))->get() as $sub)
                                            <option value="{{ $sub->id }}" {{ request('subgrupo_id') == $sub->id ? 'selected' : '' }}>
                                                {{ $sub->nombre }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="fecha" class="form-label">Fecha</label>
                                <input type="date" name="fecha" id="fecha" class="form-control form-control-modern"
                                    value="{{ request('fecha') }}" required>
                            </div>
                            <div class="col-md-1 d-flex align-items-end">
                                <button type="submit" class="btn btn-info btn-modern w-100">
                                    <i class="bi bi-filter"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Resultados -->
                <div class="card card-modern">
                    <div class="card-header card-header-modern d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"><i class="bi bi-table me-2"></i> Resultados del Reporte</h5>
                        <div class="d-flex">
                            <form action="{{ route('instructor.reporte.asistencias.pdf') }}" method="GET">
                                <input type="hidden" name="grupo_id" value="{{ request('grupo_id') }}">
                                <input type="hidden" name="subgrupo_id" value="{{ request('subgrupo_id') }}">
                                <input type="hidden" name="fecha" value="{{ request('fecha') }}">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa-solid fa-file-pdf"></i> Exportar PDF
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        @if(isset($asistencias) && $asistencias->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-modern">
                                    <thead>
                                        <tr>
                                            <th>Estudiante</th>
                                            <th>Grupo</th>
                                            <th>Subgrupo</th>
                                            <th>Fecha</th>
                                            <th>Estado</th>
                                            <th>Hora de Registro</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($asistencias as $asistencia)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div
                                                            class="avatar-sm bg-light rounded-circle me-2 d-flex align-items-center justify-content-center">
                                                            <i class="bi bi-person"></i>
                                                        </div>
                                                        <div>{{ $asistencia->estudiante->nombre_completo ?? 'N/A' }}</div>
                                                    </div>
                                                </td>
                                                <td>{{ $asistencia->subgrupo->grupo->nombre ?? 'N/A' }}</td>
                                                <td>{{ $asistencia->subgrupo->nombre ?? 'N/A' }}</td>
                                                <td>{{ $asistencia->fecha }}</td>
                                                <td>
                                                    @if($asistencia->estado === 'presente')
                                                        <span class="badge bg-success badge-modern">Presente</span>
                                                    @elseif($asistencia->estado === 'ausente')
                                                        <span class="badge bg-danger badge-modern">Ausente</span>
                                                    @elseif($asistencia->estado === 'justificado')
                                                        <span class="badge bg-warning badge-modern">Justificado</span>
                                                    @else
                                                        <span class="badge bg-secondary badge-modern">N/A</span>
                                                    @endif
                                                </td>
                                                <td>{{ $asistencia->hora_registro ?? 'N/A' }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Paginación -->
                            @if($asistencias->hasPages())
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination justify-content-center mt-4">
                                        {{-- Previous Page Link --}}
                                        @if ($asistencias->onFirstPage())
                                            <li class="page-item disabled">
                                                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Anterior</a>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $asistencias->previousPageUrl() }}">Anterior</a>
                                            </li>
                                        @endif

                                        {{-- Pagination Elements --}}
                                        @foreach ($asistencias->getUrlRange(1, $asistencias->lastPage()) as $page => $url)
                                            @if ($page == $asistencias->currentPage())
                                                <li class="page-item active"><a class="page-link" href="#">{{ $page }}</a></li>
                                            @else
                                                <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                            @endif
                                        @endforeach

                                        {{-- Next Page Link --}}
                                        @if ($asistencias->hasMorePages())
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $asistencias->nextPageUrl() }}">Siguiente</a>
                                            </li>
                                        @else
                                            <li class="page-item disabled">
                                                <a class="page-link" href="#">Siguiente</a>
                                            </li>
                                        @endif
                                    </ul>
                                </nav>
                            @endif
                        @else
                            <div class="text-center py-5">
                                <i class="bi bi-clipboard-x display-4 text-muted"></i>
                                <h4 class="mt-3 text-muted">No hay datos para mostrar</h4>
                                <p class="text-muted">Utilice los filtros para generar un reporte de asistencias</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const grupoSelect = document.getElementById('grupo_id');
            const subgrupoSelect = document.getElementById('subgrupo_id');
            const subgruposUrl = "{{ route('inst.get.subgrupos', ['grupoId' => 'REPLACE']) }}";

            grupoSelect.addEventListener('change', function () {
                const grupoId = this.value;
                if (grupoId) {
                    const url = subgruposUrl.replace('REPLACE', grupoId);
                    // Realiza la llamada AJAX
                    fetch(url)
                        .then(response => response.json())
                        .then(data => {
                            subgrupoSelect.innerHTML = '<option value="">Seleccione un subgrupo...</option>';
                            data.forEach(subgrupo => {
                                const option = document.createElement('option');
                                option.value = subgrupo.id;
                                option.textContent = subgrupo.nombre;
                                subgrupoSelect.appendChild(option);
                            });
                        })
                        .catch(error => console.error('Error:', error));
                } else {
                    subgrupoSelect.innerHTML = '<option value="">Seleccione un subgrupo...</option>';
                }
            });

            // Si ya hay un grupo seleccionado al cargar la página, cargar sus subgrupos
            if (grupoSelect.value) {
                grupoSelect.dispatchEvent(new Event('change'));

                // Seleccionar el subgrupo que ya estaba seleccionado
                setTimeout(() => {
                    const subgrupoId = "{{ request('subgrupo_id') }}";
                    if (subgrupoId) {
                        subgrupoSelect.value = subgrupoId;
                    }
                }, 500);
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection