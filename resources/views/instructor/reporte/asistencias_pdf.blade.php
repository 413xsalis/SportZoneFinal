<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Reporte de Asistencias - Escuela Deportiva</title>
    <style>
        @page {
            margin: 1.5cm;
            size: landscape;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
            margin: 0;
            padding: 0;
        }
        
        .container {
            max-width: 100%;
            margin: 0 auto;
        }
        
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #2c5282;
        }
        
        .logo-container {
            display: flex;
            align-items: center;
        }
        
        .logo {
            width: 80px;
            height: 80px;
            object-fit: contain;
            margin-right: 15px;
            border: 1px solid #ddd;
            padding: 5px;
            background-color: #fff;
        }
        
        .school-info {
            flex-grow: 1;
        }
        
        .school-name {
            font-size: 22px;
            font-weight: bold;
            color: #2c5282;
            margin: 0;
        }
        
        .school-subtitle {
            font-size: 14px;
            color: #4a5568;
            margin: 5px 0 0 0;
        }
        
        .report-title {
            font-size: 20px;
            text-align: center;
            font-weight: bold;
            color: #2c5282;
            margin: 15px 0;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .report-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            background-color: #f8fafc;
            padding: 12px 15px;
            border-radius: 5px;
            border-left: 4px solid #2c5282;
        }
        
        .info-column {
            margin-bottom: 5px;
        }
        
        .info-label {
            font-weight: bold;
            color: #4a5568;
            display: inline-block;
            min-width: 120px;
        }
        
        .info-value {
            color: #2d3748;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            page-break-inside: auto;
        }
        
        thead {
            display: table-header-group;
        }
        
        tr {
            page-break-inside: avoid;
            page-break-after: auto;
        }
        
        th {
            background-color: #2c5282;
            color: white;
            font-weight: bold;
            padding: 10px 8px;
            text-align: left;
            font-size: 11px;
            text-transform: uppercase;
            border: 1px solid #2a4365;
        }
        
        td {
            padding: 8px;
            border: 1px solid #ddd;
            font-size: 11px;
            vertical-align: top;
        }
        
        tbody tr:nth-child(even) {
            background-color: #f8fafc;
        }
        
        tbody tr:hover {
            background-color: #ebf8ff;
        }
        
        .status-presente {
            color: #38a169;
            font-weight: bold;
        }
        
        .status-tarde {
            color: #d69e2e;
            font-weight: bold;
        }
        
        .status-falta {
            color: #e53e3e;
            font-weight: bold;
        }
        
        .summary {
            margin-top: 20px;
            padding: 12px 15px;
            background-color: #f8fafc;
            border-radius: 5px;
            border-left: 4px solid #2c5282;
            font-size: 11px;
        }
        
        .summary-item {
            margin-bottom: 5px;
        }
        
        .summary-label {
            font-weight: bold;
            color: #4a5568;
        }
        
        footer {
            margin-top: 30px;
            padding-top: 10px;
            border-top: 1px solid #cbd5e0;
            text-align: center;
            font-size: 10px;
            color: #718096;
        }
        
        .page-number:before {
            content: "Página " counter(page);
        }
        
        .signature-area {
            margin-top: 40px;
            display: flex;
            justify-content: space-around;
        }
        
        .signature-line {
            width: 250px;
            border-top: 1px solid #2c5282;
            text-align: center;
            padding-top: 5px;
            font-size: 10px;
            color: #4a5568;
        }
        
        .no-data {
            text-align: center;
            padding: 30px;
            color: #718096;
            font-style: italic;
        }
        
        @media print {
            body {
                margin: 0;
                padding: 0;
            }
            
            .header {
                margin-top: 0;
            }
            
            th {
                background-color: #2c5282 !important;
                color: white !important;
                -webkit-print-color-adjust: exact;
            }
            
            tbody tr:nth-child(even) {
                background-color: #f8fafc !important;
                -webkit-print-color-adjust: exact;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="logo-container">
                <img class="logo" src="{{ public_path('assets/images/logo_escuela.png') }}" alt="Logo Escuela Deportiva">
                <div class="school-info">
                    <h1 class="school-name">Escuela Deportiva Safuka</h1>
                    <p class="school-subtitle">Sistema de Gestión Deportiva</p>
                </div>
            </div>
            <div class="report-info" style="text-align: right;">
                <div class="info-column"><span class="info-label">Fecha de Generación:</span> 
                    <span class="info-value">{{ $fechaGeneracion }}</span>
                </div>
            </div>
        </div>

        <h2 class="report-title">Reporte de Asistencias</h2>

        @if($asistencias->isNotEmpty())
        <div class="report-info">
            <div>
                <div class="info-column"><span class="info-label">Grupo:</span> 
                    <span class="info-value">{{ $asistencias->first()->subgrupo->grupo->nombre ?? 'N/A' }}</span>
                </div>
                <div class="info-column"><span class="info-label">Subgrupo:</span> 
                    <span class="info-value">{{ $asistencias->first()->subgrupo->nombre ?? 'N/A' }}</span>
                </div>
                <div class="info-column"><span class="info-label">Total de Registros:</span> 
                    <span class="info-value">{{ $asistencias->count() }}</span>
                </div>
            </div>
            <div>
                <div class="info-column"><span class="info-label">Rango de Fechas:</span> 
                    <span class="info-value">
                        {{ $asistencias->min('fecha') }} al {{ $asistencias->max('fecha') }}
                    </span>
                </div>
                <div class="info-column"><span class="info-label">Generado por:</span> 
                    <span class="info-value">Sistema de Gestión</span>
                </div>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th width="20%">Estudiante</th>
                    <th width="10%">Documento</th>
                    <th width="10%">Grupo</th>
                    <th width="10%">Subgrupo</th>
                    <th width="10%">Fecha</th>
                    <th width="10%">Estado</th>
                    <th width="15%">Hora de Registro</th>
                    <th width="15%">Observaciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($asistencias as $asis)
                <tr>
                    <td>{{ $asis->estudiante->nombre_completo ?? 'N/A' }}</td>
                    <td>{{ $asis->estudiante->documento ?? 'N/A' }}</td>
                    <td>{{ $asis->subgrupo->grupo->nombre ?? 'N/A' }}</td>
                    <td>{{ $asis->subgrupo->nombre ?? 'N/A' }}</td>
                    <td>{{ \Carbon\Carbon::parse($asis->fecha)->format('d/m/Y') }}</td>
                    <td class="status-{{ strtolower($asis->estado) }}">{{ $asis->estado }}</td>
                    <td>{{ $asis->hora_registro ? \Carbon\Carbon::parse($asis->hora_registro)->format('H:i') : 'N/A' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="no-data">
            <h3>No hay registros de asistencia para mostrar</h3>
            <p>No se encontraron registros de asistencia con los criterios seleccionados.</p>
        </div>
        @endif

        <footer>
            © {{ date('Y') }} Escuela Deportiva | Generado el {{ date('d/m/Y H:i') }} | Página <span class="page-number"></span>
        </footer>
    </div>

    <script>
        // Script para numeración de páginas en PDF
        var totalPages = Math.ceil(document.querySelectorAll('tbody tr').length / 15);
        if(totalPages > 1) {
            document.querySelector('.page-number').textContent = "1 de " + totalPages;
        }
    </script>
</body>

</html>
