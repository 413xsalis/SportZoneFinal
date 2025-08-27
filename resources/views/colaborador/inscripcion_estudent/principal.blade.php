@extends('colaborador.inscripcion_estudent.layout')
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
    
    .default-avatar {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        background-color: #e9ecef;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #6c757d;
        font-size: 0.9rem;
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
        
        .action-buttons {
            display: flex;
            flex-wrap: wrap;
        }
        
        .action-buttons .btn {
            margin-bottom: 0.5rem;
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
                        <div class="default-avatar-sidebar me-3">
                            <i class="bi bi-person fs-4"></i>
                        </div>
                    @endif
                    <div>
                        <h1 class="mb-1"><i class="bi bi-people me-2"></i> Inscripción de Estudiantes</h1>
                        <p class="mb-0">Módulo Colaborador - Bienvenido/a, {{ Auth::user()->name }}</p>
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
                        <div class="stats-icon" style="background-color: rgba(67, 97, 238, 0.1); color: var(--primary-color);">
                            <i class="bi bi-people-fill"></i>
                        </div>
                        <h3>{{ $estudiantes->count() }}</h3>
                        <p class="text-muted">Total Estudiantes</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card">
                        <div class="stats-icon" style="background-color: rgba(46, 204, 113, 0.1); color: #27ae60;">
                            <i class="bi bi-check-circle-fill"></i>
                        </div>
                        <h3>{{ $estudiantes->where('grupo_id', '!=', null)->count() }}</h3>
                        <p class="text-muted">Con Grupo Asignado</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card">
                        <div class="stats-icon" style="background-color: rgba(235, 87, 87, 0.1); color: #e74c3c;">
                            <i class="bi bi-x-circle-fill"></i>
                        </div>
                        <h3>{{ $estudiantes->where('grupo_id', null)->count() }}</h3>
                        <p class="text-muted">Sin Grupo Asignado</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card">
                        <div class="stats-icon" style="background-color: rgba(247, 183, 49, 0.1); color: #f39c12;">
                            <i class="bi bi-clock-fill"></i>
                        </div>
                        <h3>{{ $estudiantes->where('created_at', '>=', now()->subDays(30))->count() }}</h3>
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
                            <input type="text" class="form-control" placeholder="Buscar estudiante..." id="searchInput">
                        </div>
                    </div>
                    <div class="col-md-6 d-flex justify-content-end">
                        <select class="form-select me-2" id="grupoFilter" style="max-width: 200px; border-radius: 50px;">
                            <option value="all">Todos los grupos</option>
                            @foreach($grupos as $grupo)
                                <option value="{{ $grupo->id }}">{{ $grupo->nombre }}</option>
                            @endforeach
                            <option value="no_group">Sin grupo</option>
                        </select>
                        <a href="{{ route('estudiantes.create') }}" class="btn btn-success btn-modern">
                            <i class="bi bi-plus-circle me-1"></i> Nuevo Estudiante
                        </a>
                    </div>
                </div>
            </div>

            <div class="card card-modern">
                <div class="card-header card-header-modern d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="bi bi-table me-2"></i> Lista de Estudiantes Registrados</h5>
                    <div class="d-flex">
                        <button class="btn btn-sm btn-outline-secondary me-2" id="resetFilters">
                            <i class="bi bi-arrow-clockwise"></i> Restablecer
                        </button>
                        <button class="btn btn-sm btn-outline-secondary">
                            <i class="bi bi-download"></i> Exportar
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    @if($estudiantes->isEmpty())
                    <div class="empty-state">
                        <i class="bi bi-person-x"></i>
                        <h3>No hay estudiantes registrados</h3>
                        <p>Comienza agregando un nuevo estudiante al sistema.</p>
                        <a href="{{ route('estudiantes.create') }}" class="btn btn-success mt-3">
                            <i class="bi bi-plus-circle"></i> Agregar Estudiante
                        </a>
                    </div>
                    @else
                    <div class="table-responsive">
                        <table class="table table-modern" id="estudiantesTable">
                            <thead>
                                <tr>
                                    <th>Documento</th>
                                    <th>Nombre</th>
                                    <th>Teléfono</th>
                                    <th>Contacto</th>
                                    <th>Tel. Contacto</th>
                                    <th>EPS</th>
                                    <th>Grupo/Nivel</th>
                                    <th width="120px">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($estudiantes as $est)
                                <tr data-grupo="{{ $est->grupo ? $est->grupo->id : 'no_group' }}">
                                    <td><strong>{{ $est->documento }}</strong></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="default-avatar me-2">
                                                <i class="bi bi-person"></i>
                                            </div>
                                            <div>{{ $est->nombre_1 }} {{ $est->apellido_1 }}</div>
                                        </div>
                                    </td>
                                    <td>{{ $est->telefono }}</td>
                                    <td>{{ $est->nombre_contacto }}</td>
                                    <td>{{ $est->telefono_contacto }}</td>
                                    <td>{{ $est->eps }}</td>
                                    <td>
                                        @if($est->grupo)
                                            <span class="badge bg-success badge-modern">{{ $est->grupo->nombre }}</span>
                                        @else
                                            <span class="badge bg-warning badge-modern">Sin grupo</span>
                                        @endif
                                    </td>
                                    <td class="action-buttons">
                                        <a href="{{ route('estudiante.edit', $est->documento) }}" class="btn btn-sm btn-outline-primary" title="Editar">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('estudiantes.destroy', $est->documento) }}" method="POST" class="d-inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Eliminar" onclick="return confirm('¿Estás seguro de eliminar este estudiante?')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Paginación -->
                    @if($estudiantes->hasPages())
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center mt-4">
                            {{-- Previous Page Link --}}
                            @if ($estudiantes->onFirstPage())
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Anterior</a>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $estudiantes->previousPageUrl() }}">Anterior</a>
                                </li>
                            @endif

                            {{-- Pagination Elements --}}
                            @foreach ($estudiantes->getUrlRange(1, $estudiantes->lastPage()) as $page => $url)
                                @if ($page == $estudiantes->currentPage())
                                    <li class="page-item active"><a class="page-link" href="#">{{ $page }}</a></li>
                                @else
                                    <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                @endif
                            @endforeach

                            {{-- Next Page Link --}}
                            @if ($estudiantes->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $estudiantes->nextPageUrl() }}">Siguiente</a>
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
        const grupoFilter = document.getElementById('grupoFilter');
        const resetFilters = document.getElementById('resetFilters');
        const table = document.getElementById('estudiantesTable');
        
        function filterTable() {
            const searchText = searchInput.value.toLowerCase();
            const grupoValue = grupoFilter.value;
            
            if (table) {
                const rows = table.getElementsByTagName('tr');
                
                for (let i = 1; i < rows.length; i++) {
                    const row = rows[i];
                    const cells = row.getElementsByTagName('td');
                    let found = false;
                    let grupoMatch = false;
                    
                    // Filtrar por grupo
                    if (grupoValue === 'all' || row.getAttribute('data-grupo') === grupoValue) {
                        grupoMatch = true;
                        
                        // Filtrar por texto de búsqueda
                        for (let j = 0; j < cells.length; j++) {
                            const cellText = cells[j].textContent.toLowerCase();
                            if (cellText.indexOf(searchText) > -1) {
                                found = true;
                                break;
                            }
                        }
                    }
                    
                    if (found && grupoMatch) {
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
        
        if (grupoFilter) {
            grupoFilter.addEventListener('change', filterTable);
        }
        
        if (resetFilters) {
            resetFilters.addEventListener('click', function() {
                searchInput.value = '';
                grupoFilter.value = 'all';
                filterTable();
            });
        }

        // Tooltips para botones
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[title]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>
@endsection