<!DOCTYPE html>
<html>

<head>
    <title>Reporte de Asistencias</title>
    <style>
        body {
            font-family: 'Times New Roman', sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .header {
            margin-bottom: 30px;
        }

        .report-title {
            font-size: 24px;
            text-align: center;
            margin-bottom: 15px;
        }

        .info-column {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .info-label {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="header">
        <img src="{{ public_path('assets/images/logo_escuela.png') }}" alt="Logo">
        <h2>Escuela Deportiva</h2>
        <h2>Reporte de Inscripciones</h2> 
        <div class="report-title">Reporte de Asistencias</div>
        @if($asistencias->isNotEmpty())
            <div style="float: left;">
                <div class="info-column"><span class="info-label">Grupo:</span>
                    {{ $asistencias->first()->subgrupo->grupo->nombre ?? 'N/A' }}</div>
                <div class="info-column"><span class="info-label">Subgrupo:</span>
                    {{ $asistencias->first()->subgrupo->nombre ?? 'N/A' }}</div>
                <div class="info-column"><span class="info-label">Fecha de Generacion:</span> {{ $fechaGeneracion }}</div>
            </div>
            <div style="clear: both;"></div>
        @endif
    </div>
    <table>
        <thead>
            <tr>
                <th>Estudiante</th>
                <th>Documento</th>
                <th>Grupo</th>
                <th>Subgrupo</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Hora de Registro</th>
            </tr>
        </thead>
        <tbody>
            @forelse($asistencias as $asis)
                <tr>
                    <td>{{ $asis->estudiante->nombre_completo ?? 'N/A' }}</td>
                    <td>{{ $asis->estudiante->documento ?? 'N/A' }}</td>
                    <td>{{ $asis->subgrupo->grupo->nombre ?? 'N/A' }}</td>
                    <td>{{ $asis->subgrupo->nombre ?? 'N/A' }}</td>
                    <td>{{ $asis->fecha }}</td>
                    <td>{{ $asis->estado }}</td>
                    <td>{{ $asis->hora_registro ?? 'N/A' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">No hay registros de asistencia para mostrar.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <footer>
        © {{ date('Y') }} Escuela Deportiva Safuka | Generado el {{ date('d/m/Y H:i') }}
    </footer>

</body>

</html>