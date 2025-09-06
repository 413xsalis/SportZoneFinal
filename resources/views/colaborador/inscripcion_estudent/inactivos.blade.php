@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3 class="mb-3">🚫 Estudiantes Inactivos</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-hover text-center align-middle">
        <thead class="table-danger">
            <tr>
                <th>Documento</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($estudiantes as $estudiante)
                <tr>
                    <td>{{ $estudiante->documento }}</td>
                    <td>{{ $estudiante->nombre_1 }}</td>
                    <td>{{ $estudiante->apellido_1 }}</td>
                    <td>
                        <span class="badge bg-danger">Inactivo</span>
                    </td>
                    <td>
                        <form action="{{ route('estudiantes.cambiarEstado', $estudiante->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-success btn-sm">
                                Activar
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No hay estudiantes inactivos.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <a href="{{ route('estudiantes.index') }}" class="btn btn-secondary mt-3">Ver Activos</a>
</div>
@endsection
