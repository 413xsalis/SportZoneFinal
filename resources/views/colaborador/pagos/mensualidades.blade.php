@extends('colaborador.pagos.partials.layout')

@section('title', 'Gestión de Mensualidades')
@section('contenido')

<style>
    :root {
        --primary-color: #4361ee;
        --secondary-color: #3a0ca3;
        --success-color: #4cc9f0;
        --light-bg: #f8f9fa;
        --card-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
        --hover-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
    }
    
    .app-container {
        max-width: 1400px;
        margin: 0 auto;
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
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        border-bottom: none;
        padding: 1.5rem;
    }
    
    .form-control, .form-select {
        border-radius: 10px;
        padding: 0.75rem 1rem;
        border: 1px solid #e2e8f0;
        transition: all 0.3s ease;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.25rem rgba(67, 97, 238, 0.15);
    }
    
    .btn-modern {
        border-radius: 50px;
        padding: 0.75rem 1.5rem;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    
    .btn-primary {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        border: none;
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(67, 97, 238, 0.4);
    }
    
    .alert-modern {
        border-radius: 12px;
        border: none;
        box-shadow: var(--card-shadow);
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
    }
    
    .badge-modern {
        padding: 0.5em 0.8em;
        border-radius: 50px;
        font-weight: 500;
        font-size: 0.85em;
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
    
    .action-buttons .btn {
        border-radius: 8px;
        padding: 0.4rem 0.8rem;
        margin-right: 0.5rem;
        transition: all 0.3s ease;
    }
    
    .action-buttons .btn:hover {
        transform: translateY(-2px);
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
        .action-buttons {
            display: flex;
            flex-wrap: wrap;
        }
        
        .action-buttons .btn {
            margin-bottom: 0.5rem;
        }
    }
</style>

<div class="container py-4">
    <div class="app-container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0"><i class="bi bi-calendar-check me-2"></i> Registro de Mensualidades</h2>
        </div>

        {{-- Mensaje de éxito --}}
        @if(session('success'))
            <div class="alert alert-success alert-modern mb-4">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            </div>
        @endif

        {{-- Tarjetas de estadísticas --}}
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="stats-card">
                    <div class="stats-icon" style="background-color: rgba(67, 97, 238, 0.1); color: var(--primary-color);">
                        <i class="bi bi-currency-dollar"></i>
                    </div>
                    <h3>${{ number_format($pagos->sum('valor'), 0, ',', '.') }}</h3>
                    <p class="text-muted">Total Recaudado</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card">
                    <div class="stats-icon" style="background-color: rgba(46, 204, 113, 0.1); color: #27ae60;">
                        <i class="bi bi-receipt"></i>
                    </div>
                    <h3>{{ $pagos->count() }}</h3>
                    <p class="text-muted">Total Mensualidades</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card">
                    <div class="stats-icon" style="background-color: rgba(247, 183, 49, 0.1); color: #f39c12;">
                        <i class="bi bi-people"></i>
                    </div>
                    <h3>{{ $estudiantes->count() }}</h3>
                    <p class="text-muted">Estudiantes Registrados</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card">
                    <div class="stats-icon" style="background-color: rgba(235, 87, 87, 0.1); color: #e74c3c;">
                        <i class="bi bi-calendar-x"></i>
                    </div>
                    <h3>{{ $estudiantes->count() - $pagos->count() }}</h3>
                    <p class="text-muted">Pendientes por Pagar</p>
                </div>
            </div>
        </div>

        {{-- FORMULARIO --}}
        <div class="card card-modern mb-4">
            <div class="card-header card-header-modern">
                <h5 class="mb-0"><i class="bi bi-plus-circle me-2"></i> Registrar Nueva Mensualidad</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('pagos.mensualidades.store') }}" method="POST" id="mensualidadForm">
                    @csrf
                    <input type="hidden" name="tipo" value="mensualidad">

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="estudiante_documento" class="form-label">Estudiante <span class="text-danger">*</span></label>
                            <select name="estudiante_documento" id="estudiante_documento" class="form-select" required>
                                <option value="">Seleccione un estudiante</option>
                                @foreach($estudiantes as $estudiante)
                                    <option value="{{ $estudiante->documento }}">
                                        {{ $estudiante->nombre_1 }} {{ $estudiante->apellido_1 }} ({{ $estudiante->documento }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="valor" class="form-label">Valor ($) <span class="text-danger">*</span></label>
                            <input type="number" name="valor" id="valor" class="form-control" min="0" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="concepto" class="form-label">Concepto <span class="text-danger">*</span></label>
                            <input type="text" name="concepto" id="concepto" class="form-control" required>
                            <div class="form-text">Ej: Mensualidad Enero 2024, Abonos, etc.</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="fecha_pago" class="form-label">Fecha de Pago <span class="text-danger">*</span></label>
                            <input type="date" name="fecha_pago" id="fecha_pago" class="form-control" value="{{ date('Y-m-d') }}" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="medio_pago" class="form-label">Medio de Pago <span class="text-danger">*</span></label>
                            <select name="medio_pago" id="medio_pago" class="form-select" required>
                                <option value="">Seleccione una opción</option>
                                <option value="efectivo">Efectivo</option>
                                <option value="nequi">Nequi</option>
                                <option value="daviplata">Daviplata</option>
                                <option value="transferencia">Transferencia bancaria</option>
                                <option value="tarjeta">Tarjeta débito/crédito</option>
                            </select>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary btn-modern">
                            <i class="bi bi-check-circle me-1"></i> Registrar Mensualidad
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- LISTADO --}}
        <div class="card card-modern">
            <div class="card-header card-header-modern d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="bi bi-list-check me-2"></i> Mensualidades Registradas</h5>
                <div class="d-flex">
                    <button class="btn btn-sm btn-outline-secondary me-2" id="btnExportar">
                        <i class="bi bi-download me-1"></i> Exportar
                    </button>
                </div>
            </div>
            <div class="card-body p-0">
                @if($pagos->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-modern" id="tablaMensualidades">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Estudiante</th>
                                    <th class="text-center">Fecha de pago</th>
                                    <th class="text-end">Valor</th>
                                    <th class="text-center">Medio de pago</th>
                                    <th>Concepto</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pagos as $index => $pago)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="default-avatar me-2">
                                                    <i class="bi bi-person"></i>
                                                </div>
                                                <div>
                                                    {{ $pago->estudiante->nombre_1 ?? 'No asignado' }} {{ $pago->estudiante->apellido_1 ?? '' }}
                                                    <br>
                                                    <small class="text-muted">Doc: {{ $pago->estudiante_documento }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">{{ \Carbon\Carbon::parse($pago->fecha_pago)->format('d/m/Y') }}</td>
                                        <td class="text-end">${{ number_format($pago->valor, 0, ',', '.') }}</td>
                                        <td class="text-center">
                                            <span class="badge bg-info badge-modern">{{ ucfirst($pago->medio_pago) }}</span>
                                        </td>
                                        <td>{{ $pago->concepto }}</td>
                                        <td class="text-center action-buttons">
                                            <a href="{{ route('pagos.pagos.edit', $pago->id) }}" class="btn btn-sm btn-outline-primary" title="Editar">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('pagos.pagos.destroy', $pago->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Eliminar"
                                                    onclick="return confirm('¿Seguro que deseas eliminar este pago?')">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="bi bi-calendar-x display-4 text-muted"></i>
                        <p class="mt-3">No hay mensualidades registradas</p>
                        <a href="#" class="btn btn-primary btn-sm" onclick="document.getElementById('estudiante_documento').focus()">
                            <i class="bi bi-plus-circle"></i> Registrar primera mensualidad
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Establecer fecha actual por defecto
        document.getElementById('fecha_pago').value = new Date().toISOString().split('T')[0];
        
        // Botón de exportar
        document.getElementById('btnExportar').addEventListener('click', function() {
            // Aquí puedes implementar la funcionalidad de exportación
            alert('Funcionalidad de exportación en desarrollo');
        });
        
        // Validación del formulario
        const form = document.getElementById('mensualidadForm');
        form.addEventListener('submit', function(e) {
            const valor = document.getElementById('valor').value;
            if (valor <= 0) {
                e.preventDefault();
                alert('El valor de la mensualidad debe ser mayor a cero');
                document.getElementById('valor').focus();
            }
        });

        // Sugerir concepto basado en el mes actual
        const conceptoInput = document.getElementById('concepto');
        const meses = [
            'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
            'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
        ];
        const mesActual = meses[new Date().getMonth()];
        const añoActual = new Date().getFullYear();
        
        conceptoInput.placeholder = `Ej: Mensualidad ${mesActual} ${añoActual}`;
    });
</script>

@endsection