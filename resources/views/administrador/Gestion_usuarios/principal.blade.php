@extends('administrador.Gestion_usuarios.layout')
@section('title', 'Gestión de Usuarios')
@section('content')
    <main class="content">
        <div class="container py-5">
            <!-- ENCABEZADO CON INFORMACIÓN DEL ADMINISTRADOR -->
            <div class="app-title">
                <div class="d-flex align-items-center">

                    
                    <div>
                        <h1 class="mb-4"><i class="bi bi-people me-2"></i> Gesti&oacute;n de Usuarios</h1>
                        <p class="mb-0">Bienvenido/a, {{ Auth::user()->name }}</p> <!-- Saludo personalizado -->
                    </div>
                </div>
            </div>
            
            <!-- ALERTA DE ÉXITO (se muestra cuando hay un mensaje de éxito en la sesión) -->
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle me-2"></i> {{ $message }} <!-- Icono y mensaje -->
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- TARJETAS DE ESTADÍSTICAS -->
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="stats-card stats-card-primary">
                        <p class="stats-number">{{ $totalUsers }}</p> <!-- Total de usuarios -->
                        <p class="stats-label">Usuarios Totales</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stats-card stats-card-success">
                        <p class="stats-number">{{ $activeUsers }}</p> <!-- Usuarios activos -->
                        <p class="stats-label">Usuarios Activos</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stats-card stats-card-danger">
                        <p class="stats-number">{{ $inactiveUsers }}</p> <!-- Usuarios inactivos -->
                        <p class="stats-label">Usuarios Inactivos</p>
                    </div>
                </div>
            </div>

            <!-- TABLA DE LISTA DE USUARIOS -->
            <div class="card">
                <div
                    class="card-header d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                    <h5 class="mb-2 mb-md-0"><i class="bi bi-table me-2"></i> Lista de Usuarios</h5>
                    <div class="d-flex flex-column flex-md-row">
                        <!-- BARRA DE BÚSQUEDA -->
                        <div class="search-box me-md-2 mb-2 mb-md-0">
                            <i class="bi bi-search"></i>
                            <input type="text" class="form-control" placeholder="Buscar usuario..." id="searchInput">
                        </div>
                        <!-- BOTÓN PARA ACCEDER A LA PAPELERA DE USUARIOS ELIMINADOS -->
                        <a href="{{ route('usuarios.trashed') }}" class="btn btn-warning">
                            <i class="bi bi-trash me-1"></i> Papelera ({{ $inactiveUsers }})
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive"> <!-- Tabla responsiva -->
                        <table class="table table-hover" id="usersTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Correo</th>
                                    <th>Rol</th>
                                    <th>Estado</th>
                                    <th width="200px">Acciones</th> <!-- Ancho fijo para columna de acciones -->
                                </tr>
                            </thead>
                            <tbody>
                                <!-- ITERACIÓN SOBRE LA LISTA DE USUARIOS -->
                                @foreach ($users as $usuario)
                                    <tr>
                                        <td><strong>#{{ $usuario->id }}</strong></td> <!-- ID con formato -->
                                        <td>{{ $usuario->name }}</td> <!-- Nombre del usuario -->
                                        <td>{{ $usuario->email }}</td> <!-- Correo del usuario -->
                                        <td>
                                            <!-- MUESTRA LOS ROLES DEL USUARIO CON BADGES COLORIDOS -->
                                            @if($usuario->roles->count() > 0)
                                                @foreach($usuario->roles as $role)
                                                    @if($role->name == 'Administrador')
                                                        <span class="role-badge role-admin">{{ $role->name }}</span>
                                                    @elseif($role->name == 'Colaborador')
                                                        <span class="role-badge role-colab">{{ $role->name }}</span>
                                                    @elseif($role->name == 'Usuario')
                                                        <span class="role-badge role-user">{{ $role->name }}</span>
                                                    @else
                                                        <span class="role-badge role-other">{{ $role->name }}</span>
                                                    @endif
                                                @endforeach
                                            @else
                                                <span class="text-muted">Sin roles asignados</span>
                                            @endif
                                        </td>
                                        <td>
                                            <!-- INDICADOR DE ESTADO (ACTIVO/INACTIVO) -->
                                            @if($usuario->trashed())
                                                <span class="badge bg-danger">Inactivo</span> <!-- Usuario desactivado -->
                                            @else
                                                <span class="badge bg-success">Activo</span> <!-- Usuario activo -->
                                            @endif
                                        </td>
                                        <td class="action-buttons">
                                            <!-- BOTÓN PARA EDITAR USUARIO -->
                                            <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn btn-sm btn-primary"
                                                title="Editar usuario">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <!-- FORMULARIO PARA DESACTIVAR USUARIO (solo si está activo) -->
                                            @if(!$usuario->trashed())
                                                <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" title="Desactivar usuario"
                                                        onclick="return confirm('¿Estás seguro de desactivar este usuario?')">
                                                        <i class="fas fa-user-slash"></i>
                                                    </button>
                                                </form>
                                            @endif

                                            <!-- BOTÓN PARA VER DETALLES DEL USUARIO -->
                                            <a href="{{ route('usuarios.show', $usuario->id) }}" class="btn btn-sm btn-info" title="Ver detalles">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- PAGINACIÓN (si es necesario) -->
                    @if($users->hasPages())
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <div class="text-muted">
                                Mostrando {{ $users->firstItem() }} - {{ $users->lastItem() }} de {{ $users->total() }}
                                registros <!-- Información del rango mostrado -->
                            </div>
                            <nav>
                                {{ $users->links() }} <!-- Links de paginación de Laravel -->
                            </nav>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </main>
    
    <!-- SCRIPTS JAVASCRIPT -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // BÚSQUEDA EN TIEMPO REAL EN LA TABLA
            const searchInput = document.getElementById('searchInput');
            const table = document.getElementById('usersTable');
            const rows = table.getElementsByTagName('tr');

            searchInput.addEventListener('keyup', function () {
                const searchText = this.value.toLowerCase();

                // Itera sobre todas las filas de la tabla (empezando desde 1 para saltar el encabezado)
                for (let i = 1; i < rows.length; i++) {
                    const row = rows[i];
                    const cells = row.getElementsByTagName('td');
                    let found = false;

                    // Busca el texto en todas las celdas de la fila
                    for (let j = 0; j < cells.length; j++) {
                        const cellText = cells[j].textContent.toLowerCase();
                        if (cellText.indexOf(searchText) > -1) {
                            found = true;
                            break;
                        }
                    }

                    // Muestra u oculta la fila según si se encontró el texto
                    if (found) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                }
            });

            // INICIALIZACIÓN DE TOOLTIPS DE BOOTSTRAP
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[title]'));
            tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>
@endsection