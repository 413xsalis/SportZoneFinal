<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Reporte de Pagos - Escuela Deportiva</title>
    <style>
        @page {
            margin: 1.2cm;
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
        
        .date-range {
            text-align: center;
            margin-bottom: 20px;
            padding: 10px;
            background-color: #ebf8ff;
            border-radius: 6px;
            font-weight: 600;
            color: #2c5282;
            border: 1px solid #90cdf4;
        }
        
        .date-range span {
            margin: 0 15px;
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
            min-width: 140px;
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
            vertical-align: middle;
        }
        
        tbody tr:nth-child(even) {
            background-color: #f8fafc;
        }
        
        tbody tr:hover {
            background-color: #ebf8ff;
        }
        
        .number-col {
            text-align: center;
            width: 50px;
            font-weight: bold;
            color: #4a5568;
        }
        
        .name-col {
            width: 20%;
        }
        
        .type-col {
            width: 15%;
        }
        
        .value-col {
            width: 12%;
            text-align: right;
            font-weight: bold;
        }
        
        .date-col {
            width: 15%;
        }
        
        .status-col {
            width: 12%;
            text-align: center;
        }
        
        .status-pagado {
            color: #38a169;
            font-weight: bold;
            background-color: #f0fff4;
            padding: 3px 8px;
            border-radius: 12px;
            display: inline-block;
            font-size: 10px;
        }
        
        .status-pendiente {
            color: #d69e2e;
            font-weight: bold;
            background-color: #fffbeb;
            padding: 3px 8px;
            border-radius: 12px;
            display: inline-block;
            font-size: 10px;
        }
        
        .status-vencido {
            color: #e53e3e;
            font-weight: bold;
            background-color: #fff5f5;
            padding: 3px 8px;
            border-radius: 12px;
            display: inline-block;
            font-size: 10px;
        }
        
        .summary {
            margin-top: 20px;
            padding: 15px;
            background-color: #f8fafc;
            border-radius: 6px;
            border-left: 4px solid #2c5282;
            font-size: 11px;
            display: flex;
            justify-content: space-between;
        }
        
        .summary-item {
            margin-bottom: 5px;
        }
        
        .summary-label {
            font-weight: bold;
            color: #4a5568;
        }
        
        .summary-value {
            color: #2c5282;
            font-weight: bold;
            font-size: 14px;
        }
        
        .financial-summary {
            margin-top: 15px;
            padding: 15px;
            background: linear-gradient(to right, #ebf8ff, #bee3f8);
            border-radius: 6px;
            border-left: 4px solid #3182ce;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
        }
        
        .financial-item {
            text-align: center;
        }
        
        .financial-label {
            font-size: 11px;
            color: #4a5568;
            margin-bottom: 5px;
        }
        
        .financial-amount {
            font-size: 16px;
            font-weight: bold;
            color: #2c5282;
        }
        
        footer {
            margin-top: 30px;
            padding-top: 15px;
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
            padding: 40px;
            color: #718096;
            font-style: italic;
            background-color: #f8fafc;
            border-radius: 8px;
            margin-top: 20px;
        }
        
        .no-data h3 {
            color: #a0aec0;
            margin-bottom: 10px;
        }
        
        .currency {
            font-family: 'Courier New', monospace;
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
            
            .date-range {
                background-color: #ebf8ff !important;
                -webkit-print-color-adjust: exact;
            }
            
            .financial-summary {
                background: linear-gradient(to right, #ebf8ff, #bee3f8) !important;
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
                    <span class="info-value">{{ date('d/m/Y H:i') }}</span>
                </div>
            </div>
        </div>

        <h2 class="report-title">Reporte de Pagos</h2>
        
        <div class="date-range">
            <span>Desde: {{ \Carbon\Carbon::parse($inicio)->format('d/m/Y') }}</span>
            • 
            <span>Hasta: {{ \Carbon\Carbon::parse($fin)->format('d/m/Y') }}</span>
        </div>

        @if($pagos->isNotEmpty())
        <div class="report-info">
            <div>
                <div class="info-column"><span class="info-label">Total de Pagos:</span> 
                    <span class="info-value">{{ $pagos->count() }}</span>
                </div>
                <div class="info-column"><span class="info-label">Período:</span> 
                    <span class="info-value">{{ \Carbon\Carbon::parse($inicio)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($fin)->format('d/m/Y') }}</span>
                </div>
            </div>
            <div>
                <div class="info-column"><span class="info-label">Primer pago:</span> 
                    <span class="info-value">{{ $pagos->min('fecha_pago') ? \Carbon\Carbon::parse($pagos->min('fecha_pago'))->format('d/m/Y') : 'N/A' }}</span>
                </div>
                <div class="info-column"><span class="info-label">Último pago:</span> 
                    <span class="info-value">{{ $pagos->max('fecha_pago') ? \Carbon\Carbon::parse($pagos->max('fecha_pago'))->format('d/m/Y') : 'N/A' }}</span>
                </div>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th class="number-col">ID</th>
                    <th class="name-col">Estudiante</th>
                    <th class="type-col">Tipo</th>
                    <th class="value-col">Valor</th>
                    <th class="date-col">Fecha de Pago</th>
                    <th class="status-col">Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pagos as $pago)
                <tr>
                    <td class="number-col">{{ $pago->id }}</td>
                    <td>
                        {{ $pago->estudiante->nombre_1 ?? 'N/A' }} 
                        {{ $pago->estudiante->apellido_1 ?? '' }}
                    </td>
                    <td>{{ ucfirst($pago->tipo) }}</td>
                    <td class="value-col currency">${{ number_format($pago->valor, 0, ',', '.') }}</td>
                    <td>{{ $pago->fecha_pago ? \Carbon\Carbon::parse($pago->fecha_pago)->format('d/m/Y') : 'N/A' }}</td>
                        <td>{{ ucfirst($pago->estado) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        @php
            $totalPagado = $pagos->where('estado', 'pagado')->sum('valor');
            $totalPendiente = $pagos->where('estado', 'pendiente')->sum('valor');
            $totalVencido = $pagos->where('estado', 'vencido')->sum('valor');
            $totalGeneral = $pagos->sum('valor');
        @endphp


        <div class="summary">
            <div class="summary-item">
                <span class="summary-label">Total de pagos:</span> 
                <span class="summary-value">{{ $pagos->count() }}</span>
            </div>
            <div class="summary-item">
                <span class="summary-label">Valor total general:</span> 
                <span class="summary-value currency">${{ number_format($totalGeneral, 0, ',', '.') }}</span>
            </div>

        </div>

        <div class="signature-area">
            <div class="signature-line">
                Responsable de Finanzas
            </div>
            <div class="signature-line">
                Coordinador Administrativo
            </div>
        </div>
        @else
        <div class="no-data">
            <h3>No hay pagos registrados</h3>
            <p>No se encontraron pagos en el período seleccionado.</p>
        </div>
        @endif

        <footer>
            © {{ date('Y') }} Escuela Deportiva Safuka | Generado el {{ date('d/m/Y H:i') }} | Página <span class="page-number"></span>
        </footer>
    </div>

    <script>
        // Script para numeración de páginas
        var totalPages = Math.ceil(document.querySelectorAll('tbody tr').length / 20);
        if(totalPages > 1) {
            document.querySelector('.page-number').textContent = "1 de " + totalPages;
        }
    </script>
</body>

</html>