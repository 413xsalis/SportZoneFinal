@extends('layouts.app')

@section('content')

    <style>
        /* Fondo de toda la página */
        body {
            background: linear-gradient(135deg, #cce0ff, #6699ff);
            min-height: 100vh;
            margin: 0;
            padding: 0;
        }

        /* Ajustar contenedor para bajar la card */
        .container {
            padding-top: 60px;
            /* separa la card del borde superior */
        }

        /* Card con sombra y bordes redondeados (opcional) */
        .card {
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Contenedor principal */
        .eliminados-container {
            background-color: #e6f0ff;
            /* azul muy claro */
            padding: 20px;
            border-radius: 8px;
        }

        /* Encabezado "Pagos Eliminados" */
        .eliminados-header {
            background-color: #3366cc;
            /* azul intenso */
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* Tabla personalizada */
        .table-eliminados {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        /* Encabezados de la tabla */
        .table-eliminados th {
            background-color: #6699ff;
            /* azul medio */
            color: white;
            padding: 8px;
            text-align: left;
        }

        /* Filas de la tabla */
        .table-eliminados td {
            background-color: #cce0ff;
            /* azul muy claro */
            padding: 8px;
        }

        /* Botón Restaurar */
        .btn-restaurar {
            background-color: #0052cc;
            /* azul oscuro */
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-restaurar:hover {
            background-color: #003d99;
            /* azul más oscuro al pasar el mouse */
        }

        /* Botón Volver */
        .btn-volver {
            background-color: #3366cc;
            color: white;
        }

        .btn-volver:hover {
            background-color: #254d99;
        }
    </style>

    <div class="container py-4 eliminados-container">
        <div class="card shadow-sm border-0 rounded-3">
            <!-- Header personalizado -->
            <div class="card-header eliminados-header">
                <h4 class="mb-0">
                    <i class="bi bi-trash"></i> Pagos Eliminados
                </h4>
                <span class="badge bg-light text-dark">
                    Total: {{ $pagos->count() }}
                </span>
            </div>

            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if($pagos->isEmpty())
                    <div class="alert alert-info text-center">
                        No hay pagos eliminados en este momento.
                    </div>
                @else
                    <table class="table-eliminados">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Estudiante</th>
                                <th>Tipo</th>
                                <th>Valor</th>
                                <th>Fecha Pago</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pagos as $pago)
                                <tr>
                                    <td>{{ $pago->id }}</td>
                                    <td>{{ $pago->estudiante->nombre_completo ?? 'No asignado' }}</td>
                                    <td>{{ ucfirst($pago->tipo) }}</td>
                                    <td>${{ number_format($pago->valor, 0, ',', '.') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($pago->fecha_pago)->format('d/m/Y') }}</td>
                                    <td>
                                        <form action="{{ route('pagos.restaurar', $pago->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn-restaurar"
                                                onclick="return confirm('¿Restaurar este pago?')">
                                                <i class="bi bi-arrow-counterclockwise"></i> Restaurar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>

            <div class="card-footer text-end">
                <a href="{{ route('pagos.dashboard') }}" class="btn btn-volver">
                    <i class="bi bi-arrow-left"></i> Volver
                </a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="app.js"></script>

@endsection