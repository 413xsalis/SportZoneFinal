@extends('administrador.Gestion_usuarios.layout')

@section('content')
    <div class="container">
        <!-- TÍTULO DE LA PÁGINA -->
        <h1>Papelera de Usuarios</h1>

        <!-- ALERTA DE ÉXITO - Se muestra cuando hay un mensaje de éxito en la sesión -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- BOTÓN PARA VOLVER A LA GESTIÓN PRINCIPAL DE USUARIOS -->
        <a href="{{ route('admin.gestion') }}" class="btn btn-primary mb-3">
            Volver a usuarios
        </a>

        <!-- TABLA DE USUARIOS ELIMINADOS -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Eliminado el</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <!-- ITERACIÓN SOBRE LOS USUARIOS ELIMINADOS -->
                @foreach($users as $user)
                    <tr>
                        <!-- ID DEL USUARIO -->
                        <td>{{ $user->id }}</td>

                        <!-- NOMBRE DEL USUARIO -->
                        <td>{{ $user->name }}</td>

                        <!-- EMAIL DEL USUARIO -->
                        <td>{{ $user->email }}</td>

                        <!-- FECHA DE ELIMINACIÓN (formateada) -->
                        <td>{{ $user->deleted_at->format('d/m/Y H:i') }}</td>

                        <!-- ACCIONES DISPONIBLES -->
                        <td>
                            <!-- FORMULARIO PARA RESTAURAR USUARIO -->
                            <form action="{{ route('usuarios.restore', $user->id) }}" method="POST" style="display:inline;">
                                @csrf <!-- Token de seguridad CSRF -->
                                <button type="submit" class="btn btn-success">Restaurar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@endsection