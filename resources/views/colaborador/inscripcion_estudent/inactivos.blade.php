@extends('layouts.app')

@section('content')
    <style>
        body {
            background: linear-gradient(135deg, #d7f9d5, #a1f9c7);
            /* degradado verde */
            min-height: 100vh;
            padding: 30px 0;
        }

        .card-custom {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            max-width: 1000px;
            margin: auto;
        }

        .card-header-custom {
            background-color: #28a745;
            /* verde */
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
            font-size: 18px;
            font-weight: 600;
        }

        .contador {
            background: rgba(255, 255, 255, 0.2);
            padding: 4px 10px;
            border-radius: 12px;
            font-weight: 500;
            margin-right: 10px;
        }

        .table-responsive {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        thead {
            background-color: #85e0a5;
            /* verde claro */
            color: #1b4332;
        }

        thead th {
            padding: 12px;
            text-align: left;
        }

        tbody tr {
            background-color: #e6f4ea;
            /* verde muy suave */
            transition: background 0.3s;
        }

        tbody tr:hover {
            background-color: #d0f0c0;
        }

        tbody td {
            padding: 12px;
            vertical-align: middle;
        }

        .btn-action {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 6px 14px;
            border-radius: 6px;
            font-size: 14px;
        }

        .btn-action:hover {
            background-color: #1e7e34;
        }

        .btn-back {
            background-color: #2ecc71;
            color: white;
            border: none;
            padding: 8px 18px;
            border-radius: 6px;
            font-size: 14px;
            float: right;
            margin: 15px;
        }

        .btn-back:hover {
            background-color: #27ae60;
        }

        .card-footer {
            padding: 15px;
            text-align: center;
            background-color: #f1f1f1;
        }
    </style>

    <div class="card card-custom">
        <div class="card-header-custom">
            <div>
                <i class="fas fa-user-slash"></i> Estudiantes Inactivos
            </div>
            <div>
                <span class="contador">Total: {{ $inactivos->total() }}</span>
            </div>
        </div>

        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Documento</th>
                        <th>Nombre</th>
                        <th>Teléfono</th>
                        <th>EPS</th>
                        <th>Grupo/Nivel</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($inactivos as $estudiante)
                        <tr>
                            <td>{{ $estudiante->documento }}</td>
                            <td>{{ $estudiante->nombre_1 }} {{ $estudiante->apellido_1 }}</td>
                            <td>{{ $estudiante->telefono }}</td>
                            <td>{{ $estudiante->eps }}</td>
                            <td>
                                @if($estudiante->grupo)
                                    <span class="badge bg-success">{{ $estudiante->grupo->nombre }}</span>
                                @else
                                    <span class="badge bg-secondary">-</span>
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('estudiantes.cambiarEstado', $estudiante->documento) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn-action"
                                        onclick="return confirm('¿Estás seguro de activar este estudiante?')">
                                        <i class="fas fa-check-circle"></i> Activar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="card-footer">
            {{ $inactivos->links() }}
            <a href="{{ route('colaborador.inscripcion') }}" class="btn-back"><i class="fas fa-arrow-left"></i> Volver</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="app.js"></script>
@endsection