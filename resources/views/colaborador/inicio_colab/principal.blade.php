@extends('colaborador.inicio_colab.layout')

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
        }

        .card-header-modern {
            background: white;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            padding: 1.5rem;
        }

        .search-box {
            position: relative;
        }

        .search-box .bi-search {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
        }

        .search-box .form-control {
            padding-left: 40px;
            border-radius: 50px;
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
        }

        .search-box .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(67, 97, 238, 0.15);
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

        .action-buttons .btn {
            border-radius: 8px;
            padding: 0.4rem 0.8rem;
            margin-right: 0.5rem;
            transition: all 0.3s ease;
        }

        .action-buttons .btn:hover {
            transform: translateY(-2px);
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
            border-radius: 12px;
            padding: 1rem;
            margin-bottom: 1.5rem;
            box-shadow: var(--card-shadow);
        }

        @media (max-width: 768px) {
            .app-title {
                padding: 1rem;
            }

            .card-header-modern {
                flex-direction: column;
            }

            .search-box {
                width: 100%;
                margin-bottom: 1rem;
            }
        }
    </style>

    <main class="content">
        <div class="container py-5">
            <div class="app-container">
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
                            <h1 class="mb-1"><i class="bi bi-people me-2"></i> Gesti&oacute;n de Instructores</h1>
                            <p class="mb-0">Bienvenido/a, {{ Auth::user()->name }}</p>
                        </div>
                    </div>
                </div>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <!-- Stats Cards -->
                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="stats-card">
                            <div class="stats-icon"
                                style="background-color: rgba(67, 97, 238, 0.1); color: var(--primary-color);">
                                <i class="bi bi-people-fill"></i>
                            </div>
                            <h3>{{ $totalInstructores }}</h3>
                            <p class="text-muted">Total Instructores</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stats-card">
                            <div class="stats-icon" style="background-color: rgba(46, 204, 113, 0.1); color: #27ae60;">
                                <i class="bi bi-check-circle-fill"></i>
                            </div>
                            <h3>{{ $instructoresActivos }}</h3>
                            <p class="text-muted">Instructores Activos</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stats-card">
                            <div class="stats-icon" style="background-color: rgba(235, 87, 87, 0.1); color: #e74c3c;">
                                <i class="bi bi-x-circle-fill"></i>
                            </div>
                            <h3>{{ $instructoresInactivos }}</h3>
                            <p class="text-muted">Instructores Inactivos</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stats-card">
                            <div class="stats-icon" style="background-color: rgba(247, 183, 49, 0.1); color: #f39c12;">
                                <i class="bi bi-clock-fill"></i>
                            </div>
                            <h3>{{ $nuevosEsteMes }}</h3>
                            <p class="text-muted">Nuevos este mes</p>
                        </div>
                    </div>
                </div>

                <!-- Filters -->
                <div class="filter-section">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="search-box">
                                <i class="bi bi-search"></i>
                                <input type="text" class="form-control" placeholder="Buscar instructor..." id="searchInput">
                            </div>
                        </div>
                        <div class="col-md-6 d-flex justify-content-end">
                            <select class="form-select me-2" id="statusFilter"
                                style="max-width: 200px; border-radius: 50px;">
                                <option value="all">Todos los estados</option>
                                <option value="active">Solo activos</option>
                                <option value="inactive">Solo inactivos</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="card card-modern">
                    <div class="card-header card-header-modern d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"><i class="bi bi-table me-2"></i> Lista de Instructores</h5>
                    </div>
                    <div class="card-body">
                        @if($instructores->isEmpty())
                            <div class="empty-state">
                                <i class="bi bi-person-x"></i>
                                <h3>No hay instructores registrados</h3>
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table table-modern" id="instructoresTable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nombre</th>
                                            <th>Documento</th>
                                            <th>Teléfono</th>
                                            <th>Correo Electrónico</th>
                                            <th>Estado</th>
                                            <th width="150px">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($instructores as $instructor)
                                            <tr data-status="{{ $instructor->deleted_at ? 'inactive' : 'active' }}">
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        @if($instructor->foto_perfil && Storage::disk('public')->exists($instructor->foto_perfil))
                                                            <img src="{{ asset('storage/' . $instructor->foto_perfil) }}"
                                                                alt="Foto de perfil" class="profile-image-sidebar me-2"
                                                                style="width: 35px; height: 35px;">
                                                        @else
                                                            <div class="default-avatar me-2"
                                                                style="width: 35px; height: 35px; border-radius: 50%; background-color: #f0f0f0; display: flex; align-items: center; justify-content: center;">
                                                                <i class="bi bi-person"></i>
                                                            </div>
                                                        @endif

                                                        <strong>{{ $instructor->name }}</strong>

                                                    </div>
                                                </td>

                                                <!-- ACCESO A LOS DATOS A TRAVÉS DE LA RELACIÓN 'perfil' -->
                                                <td>{{ $instructor->documento_identidad ?? 'N/A' }}</td>
                                                <td>{{ $instructor->telefono ?? 'N/A' }}</td>

                                                <td>{{ $instructor->email }}</td>
                                                <td>
                                                    @if($instructor->deleted_at)
                                                        <span class="badge bg-danger badge-modern">Inactivo</span>
                                                    @else
                                                        <span class="badge bg-success badge-modern">Activo</span>
                                                    @endif
                                                </td>
                                                <td class="action-buttons">
                                                    <a href="{{ route('instructor.show', $instructor->id) }}"
                                                        class="btn btn-sm btn-outline-info" title="Ver detalles">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                    @if($instructor->deleted_at)
                                                        <form action="{{ route('usuario.restore', $instructor->id) }}" method="POST"
                                                            class="d-inline">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="submit" class="btn btn-sm btn-outline-success"
                                                                title="Activar">
                                                                <i class="bi bi-check-circle"></i>
                                                            </button>
                                                        </form>
                                                    @else
                                                        <form action="{{ route('usuarios.destroy', $instructor->id) }}" method="POST"
                                                            class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                                                title="Desactivar">
                                                                <i class="bi bi-trash"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Paginación -->
                            @if($instructores->hasPages())
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination justify-content-center mt-4">
                                        {{-- Previous Page Link --}}
                                        @if ($instructores->onFirstPage())
                                            <li class="page-item disabled">
                                                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Anterior</a>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $instructores->previousPageUrl() }}">Anterior</a>
                                            </li>
                                        @endif

                                        {{-- Pagination Elements --}}
                                        @foreach ($instructores->getUrlRange(1, $instructores->lastPage()) as $page => $url)
                                            @if ($page == $instructores->currentPage())
                                                <li class="page-item active"><a class="page-link" href="#">{{ $page }}</a></li>
                                            @else
                                                <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                            @endif
                                        @endforeach

                                        {{-- Next Page Link --}}
                                        @if ($instructores->hasMorePages())
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $instructores->nextPageUrl() }}">Siguiente</a>
                                            </li>
                                        @else
                                            <li class="page-item disabled">
                                                <a class="page-link" href="#">Siguiente</a>
                                            </li>
                                        @endif
                                    </ul>
                                </nav>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Búsqueda en tiempo real
            const searchInput = document.getElementById('searchInput');
            const statusFilter = document.getElementById('statusFilter');
            const table = document.getElementById('instructoresTable');

            function filterTable() {
                const searchText = searchInput.value.toLowerCase();
                const statusValue = statusFilter.value;

                if (table) {
                    const rows = table.getElementsByTagName('tr');

                    for (let i = 1; i < rows.length; i++) {
                        const row = rows[i];
                        const cells = row.getElementsByTagName('td');
                        let found = false;
                        let statusMatch = false;

                        // Filtrar por estado
                        if (statusValue === 'all' || row.getAttribute('data-status') === statusValue) {
                            statusMatch = true;

                            // Filtrar por texto de búsqueda
                            for (let j = 0; j < cells.length; j++) {
                                const cellText = cells[j].textContent.toLowerCase();
                                if (cellText.indexOf(searchText) > -1) {
                                    found = true;
                                    break;
                                }
                            }
                        }

                        if (found && statusMatch) {
                            row.style.display = '';
                        } else {
                            row.style.display = 'none';
                        }
                    }
                }
            }

            if (searchInput) {
                searchInput.addEventListener('keyup', filterTable);
            }

            if (statusFilter) {
                statusFilter.addEventListener('change', filterTable);
            }

            // Tooltips para botones
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[title]'));
            tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });

            // Confirmación para eliminar/desactivar
            const deleteForms = document.querySelectorAll('form[action*="destroy"]');
            deleteForms.forEach(form => {
                form.addEventListener('submit', function (e) {
                    if (!confirm('¿Estás seguro de que deseas desactivar este instructor?')) {
                        e.preventDefault();
                    }
                });
            });

            // Confirmación para restaurar/activar
            const restoreForms = document.querySelectorAll('form[action*="restore"]');
            restoreForms.forEach(form => {
                form.addEventListener('submit', function (e) {
                    if (!confirm('¿Estás seguro de que deseas activar este instructor?')) {
                        e.preventDefault();
                    }
                });
            });
        });
    </script>

@endsection