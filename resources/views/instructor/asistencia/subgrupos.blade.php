@extends('instructor.asistencia.layout')

@section('nav-message')
    Bienvenido - Panel de control de instructores
@endsection

@section('content')
    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3a0ca3;
            --success-color: #4cc9f0;
            --light-bg: #f5f7fb;
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

        .page-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border-radius: 16px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            box-shadow: var(--card-shadow);
            transition: all 0.3s ease;
        }

        .page-header:hover {
            box-shadow: var(--hover-shadow);
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

        .form-select-modern {
            border-radius: 12px;
            padding: 0.75rem 1rem;
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
        }

        .form-select-modern:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(67, 97, 238, 0.15);
        }

        .btn-modern {
            border-radius: 50px;
            padding: 0.75rem 1.5rem;
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

        .btn-info {
            background: linear-gradient(135deg, #4cc9f0, #3a86ff);
            border: none;
        }

        .btn-info:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(76, 201, 240, 0.4);
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
        }

        .badge-modern {
            padding: 0.5em 0.8em;
            border-radius: 50px;
            font-weight: 500;
            font-size: 0.85em;
        }

        .form-container-bottom-right {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 1000;
        }

        .form-subgrupo-simple {
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 15px 20px;
            box-shadow: var(--card-shadow);
            display: flex;
            align-items: center;
            gap: 15px;
            transition: all 0.3s ease;
        }

        .form-subgrupo-simple:hover {
            box-shadow: var(--hover-shadow);
        }

        .input-group-simple {
            display: flex;
            align-items: center;
            width: 100%;
        }

        .input-field-simple {
            flex-grow: 1;
            padding: 10px 15px;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            font-size: 0.95rem;
            color: #343a40;
            background-color: #f8f9fa;
            transition: all 0.3s ease;
        }

        .input-field-simple:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(67, 97, 238, 0.15);
        }

        .input-field-simple::placeholder {
            color: #6c757d;
        }

        .submit-button-simple {
            padding: 10px 20px;
            border: none;
            border-radius: 12px;
            font-size: 0.95rem;
            font-weight: 500;
            cursor: pointer;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
        }

        .submit-button-simple:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(67, 97, 238, 0.4);
        }

        .submit-button-simple:active {
            transform: translateY(0);
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

        .toast-modern {
            border-radius: 12px;
            box-shadow: var(--hover-shadow);
            border: none;
        }

        @media (max-width: 768px) {
            .form-subgrupo-simple {
                flex-direction: column;
                padding: 1rem;
            }

            .input-group-simple {
                width: 100%;
            }

            .submit-button-simple {
                width: 100%;
            }
        }
    </style>

    <main class="content">
        <div class="container py-5">
            <div class="app-container">
                <!-- Encabezado de página -->
                <div class="page-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h1 class="mb-1"><i class="bi bi-clipboard-check me-2"></i> Registro de Asistencia</h1>
                            <p class="mb-0">Grupo: {{ $grupo->nombre }}</p>
                        </div>
                        <div>
                            <label for="filtroSubgrupo" class="form-label text-white me-2">Filtrar por subgrupo:</label>
                            <select id="filtroSubgrupo" class="form-select-modern w-auto d-inline-block"
                                onchange="filtrarSubgrupos()">
                                <option value="todos">Mostrar todos</option>
                                @foreach($subgrupos as $subgrupo)
                                    <option value="subgrupo-{{ $subgrupo->id }}">{{ $subgrupo->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Contenido principal -->
                <div class="row">
                    @if($subgrupos->isEmpty())
                        <div class="col-12">
                            <div class="card card-modern">
                                <div class="card-body">
                                    <div class="empty-state">
                                        <i class="bi bi-people"></i>
                                        <h3>No hay subgrupos asignados</h3>
                                        <p>Comienza agregando un nuevo subgrupo a este grupo.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        @foreach($subgrupos as $subgrupo)
                            <div class="col-12 subgrupo-container subgrupo-{{ $subgrupo->id }}">
                                <div class="card card-modern">
                                    <div class="card-header-modern d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0"><i class="bi bi-collection me-2"></i> {{ $subgrupo->nombre }}</h5>
                                        <span class="badge bg-primary badge-modern">{{ $subgrupo->estudiantes->count() }}
                                            estudiantes</span>
                                    </div>
                                    <div class="card-body">
                                        @if($subgrupo->estudiantes->isEmpty())
                                            <div class="empty-state py-4">
                                                <i class="bi bi-person-x"></i>
                                                <p class="mb-0">No hay estudiantes en este subgrupo.</p>
                                            </div>
                                        @else
                                            <form method="POST" action="{{ route('instructor.asistencia.guardar') }}">
                                                @csrf
                                                <input type="hidden" name="subgrupo_id" value="{{ $subgrupo->id }}">
                                                <input type="hidden" name="fecha" value="{{ date('Y-m-d') }}">

                                                <div class="table-responsive">
                                                    <table class="table table-modern">
                                                        <thead>
                                                            <tr>
                                                                <th>Nombre del Estudiante</th>
                                                                <th>Asistencia</th>
                                                                <th>Acciones</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($subgrupo->estudiantes as $estudiante)
                                                                <tr>
                                                                    <td>
                                                                        <div class="d-flex align-items-center">
                                                                            <div
                                                                                class="avatar-sm bg-light rounded-circle me-3 d-flex align-items-center justify-content-center">
                                                                                <i class="bi bi-person"></i>
                                                                            </div>
                                                                            <div>
                                                                                <div class="fw-semibold">{{ $estudiante->nombre_1 }}
                                                                                    {{ $estudiante->apellido_1 }}
                                                                                </div>
                                                                                <small
                                                                                    class="text-muted">{{ $estudiante->documento }}</small>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <select name="asistencia[{{ $estudiante->documento }}]"
                                                                            class="form-select form-select-modern">
                                                                            <option value="presente">Presente</option>
                                                                            <option value="ausente">Ausente</option>
                                                                            <option value="justificado">Justificado</option>
                                                                        </select>
                                                                    </td>
                                                                    <td>
                                                                        <button type="button" class="btn btn-sm btn-info text-white"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#infoModal{{ $estudiante->id }}">
                                                                            <i class="bi bi-info-circle"></i> Detalles
                                                                        </button>
                                                                        @include('instructor.asistencia.partials.modal', ['estudiante' => $estudiante])
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="text-start mt-3">
                                                    <button type="submit" class="btn btn-success btn-modern">
                                                        <i class="bi bi-check-circle me-1"></i> Guardar asistencia
                                                    </button>
                                                </div>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>

        <!-- Formulario flotante para agregar subgrupos -->
        <div class="form-container-bottom-right">
            <form method="POST" action="{{ route('subgrupos.store') }}" class="form-subgrupo-simple">
                @csrf
                <input type="hidden" name="grupo_id" value="{{ $grupo->id }}">
                <div class="input-group-simple">
                    <input type="text" name="nombre" class="input-field-simple" placeholder="Nombre del nuevo subgrupo"
                        required>
                    <button type="submit" class="submit-button-simple">
                        <i class="bi bi-plus-circle"></i> Agregar
                    </button>
                </div>
            </form>
        </div>

        <!-- Toast de éxito -->
        @if(session('success'))
            <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 9999">
                <div id="attendanceToast" class="toast align-items-center text-white bg-success border-0" role="alert"
                    aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body">
                            {{ session('success') }}
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                            aria-label="Close"></button>
                    </div>
                </div>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    var toastEl = document.getElementById('attendanceToast');
                    var toast = new bootstrap.Toast(toastEl, {
                        delay: 2000 // 2000 milisegundos = 2 segundos
                    });
                    toast.show();
                });
            </script>
        @endif
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Función JavaScript para filtrar los subgrupos 
        function filtrarSubgrupos() {
            const valorSeleccionado = document.getElementById('filtroSubgrupo').value;
            const subgrupos = document.querySelectorAll('.subgrupo-container');

            subgrupos.forEach(div => {
                if (valorSeleccionado === 'todos') {
                    div.style.display = 'block';
                } else {
                    // Muestra u oculta el div dependiendo de si su clase coincide con el valor seleccionado 
                    div.style.display = div.classList.contains(valorSeleccionado) ? 'block' : 'none';
                }
            });
        }

        // Inicializar tooltips
        document.addEventListener('DOMContentLoaded', function () {
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>
@endsection