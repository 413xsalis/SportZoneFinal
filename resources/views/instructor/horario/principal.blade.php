@extends('instructor.horario.layout')

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
    max-width: 1200px;
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
    border-radius: 12px;
    overflow: hidden;
  }

  .table-modern th {
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    color: white;
    font-weight: 600;
    padding: 1rem;
    text-align: center;
    border: none;
  }

  .table-modern td {
    padding: 0.5rem;
    vertical-align: middle;
    border: 1px solid #f1f3f4;
    text-align: center;
    height: 100px;
    transition: all 0.2s ease;
  }

  .table-modern tr {
    transition: all 0.2s ease;
  }

  .table-modern tr:hover td {
    background-color: rgba(67, 97, 238, 0.03);
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
    padding: 1.5rem;
    margin-bottom: 1.5rem;
    box-shadow: var(--card-shadow);
  }

  .btn-actividad {
    border-radius: 8px;
    padding: 0.5rem;
    transition: all 0.3s ease;
    cursor: pointer;
    display: block;
    width: 100%;
    height: 100%;
    min-height: 80px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
  }

  .btn-actividad:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
  }

  .celda-horario {
    transition: all 0.3s ease;
  }

  .celda-horario:hover {
    background-color: rgba(67, 97, 238, 0.05) !important;
  }

  .modal-content {
    border-radius: 16px;
    overflow: hidden;
  }

  .modal-header {
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    color: white;
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

    .table-modern {
      font-size: 0.85rem;
    }

    .btn-actividad {
      min-height: 60px;
      padding: 0.25rem;
    }
  }
</style>
<main class="content py-5">
  <div class="app-container">
    <!-- Encabezado con información de usuario -->
    <div class="app-title">
      <div class="d-flex align-items-center">
        @if(Auth::user()->foto_perfil && Storage::disk('public')->exists(Auth::user()->foto_perfil))
        <img src="{{ asset('storage/' . Auth::user()->foto_perfil) }}" alt="Foto de perfil"
          class="profile-image-sidebar me-3">
        @else
        <div class="default-avatar default-avatar-sidebar me-3">
          <i class="bi bi-person fs-4"></i>
        </div>
        @endif
        <div>
          <h1 class="mb-1"><i class="bi bi-clipboard-check me-2"></i> Control de Horarios</h1>
          <p class="mb-0">Bienvenido/a, {{ Auth::user()->name }}</p>
        </div>
      </div>
    </div>
    <!-- Stats Cards -->

    <div class="filter-section">
      <h5 class="mb-3"><i class="bi bi-funnel me-2"></i>Filtrar Horario</h5>
      <form id="filter-form" action="{{ route('instructor.horarios') }}" method="GET">
        <div class="row align-items-end">
          <div class="col-md-8">
            <label for="instructor_select" class="form-label">Seleccionar Instructor</label>
            <select class="form-control" id="instructor_select" name="instructorId">
              <option value="">Todos los instructores</option>
              @foreach($instructores as $instructor)
              <option value="{{ $instructor->id }}">{{ $instructor->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-4">
            <button type="submit" class="btn btn-primary w-100 btn-modern">
              <i class="bi bi-funnel me-2"></i>Filtrar
            </button>
          </div>
        </div>
      </form>
    </div>


    <div class="table-responsive card card-modern">
      <div class="card-header card-header-modern">
        <h5 class="mb-0"><i class="bi bi-table me-2"></i> Horario Semanal</h5>
      </div>
      <table class="table table-modern  text-center" id="tablaHorario">
        <thead class="table-light">
          <tr>
            <th>Lunes</th>
            <th>Martes</th>
            <th>Miércoles</th>
            <th>Jueves</th>
            <th>Viernes</th>
            <th>Sábado</th>
            <th>Domingo</th>
          </tr>
        </thead>
        <tbody>
          @php
          // Extrae las horas únicas de la colección de horarios y las ordena.
          $horas = $horarios->pluck('hora_inicio')->unique()->sort()->values();
          // Define un array con los días de la semana.
          $dias = ['lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'sabado', 'domingo'];
          @endphp

          {{-- Bucle principal para iterar sobre cada hora única. --}}
          @foreach ($horas as $hora)
          <tr>
            {{-- Bucle anidado para iterar sobre cada día de la semana. --}}
            @foreach ($dias as $dia)
            @php
            // Busca si existe un evento en el horario para la hora y el día actuales. `first()` detiene el bucle tan pronto como encuentra una coincidencia.
            $evento = $horarios->first(function ($h) use ($hora, $dia) {
            return strtolower($h->dia) === strtolower($dia) && $h->hora_inicio === $hora;
            });
            @endphp
            {{-- Celda del horario. `data-*` son atributos de datos para que JavaScript pueda acceder a la
                  información.
                  --}}
            <td class="celda-horario" data-dia="{{ strtolower($dia) }}" data-hora="{{ $hora }}"
              data-horario-id="{{ $evento->id ?? '' }}" @if($evento) data-grupo="{{ $evento->grupo->nombre ?? '' }}"
              data-nombre="{{ $evento->nombre ?? '' }}" data-estado="{{ $evento->estado ?? 'Programada' }}" @endif>
              @if ($evento)
              {{-- Si hay un evento, muestra la información del grupo y el rango de horas. --}}
              <div class="bg-warning text-dark py-1 px-2 rounded btn-actividad"
                style="cursor:pointer; display:inline-block; min-width:100px;">
                <strong>{{ $evento->grupo->nombre ?? 'Sin grupo' }}</strong><br>
                <small>{{ \Carbon\Carbon::parse($evento->fecha)->format('d/m/Y') }}</small><br>
                <small>{{ substr($evento->hora_inicio, 0, 5) }} - {{ substr($evento->hora_fin, 0, 5) }}</small>
              </div>
              @else
              {{-- Si no hay evento, muestra un guion. --}}
              <span class="text-muted" style="cursor:pointer;">—</span>
              @endif
            </td>
            @endforeach
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    {{-- Incluye la plantilla del modal. --}}
    @include('instructor.horario.partials.modal')
  </div>
  @push('scripts')
  <script>
    document.getElementById('filter-form').addEventListener('submit', function(event) {
      event.preventDefault();
      const instructorId = document.getElementById('instructor_select').value;
      window.location.href = `{{ route('instructor.horarios') }}?instructorId=${instructorId}`;
    });

    document.addEventListener('DOMContentLoaded', function() {
      let selectedCell = null;

      // Obtener la URL de la ruta de guardado desde Blade
      const guardarUrl = "{{ route('instructor.horarios.guardar') }}";

      // Mapea el estado a las clases de color de Bootstrap
      const estadoColores = {
        'activo': {
          bg: 'bg-success',
          border: 'border-success',
          text: 'text-white'
        },
        'cancelado': {
          bg: 'bg-danger',
          border: 'border-danger',
          text: 'text-white'
        },
        'pendiente': {
          bg: 'bg-warning',
          border: 'border-warning',
          text: 'text-dark'
        }
      };

      // Función para aplicar los colores iniciales o por defecto
      function aplicarColorInicial() {
        document.querySelectorAll('.celda-horario').forEach(celda => {
          const estado = celda.dataset.estado;
          const contenedorActividad = celda.querySelector('.btn-actividad');

          // Si no hay una actividad preexistente en la celda
          if (!contenedorActividad) {
            const horarioId = celda.dataset.horarioId;
            const subgrupoId = celda.dataset.subgrupoId;
            const actividadNombre = celda.dataset.nombre;

            // Verifica si la celda es "asignable" (tiene horario_id pero no subgrupo_id ni nombre)
            if (horarioId && (!subgrupoId || !actividadNombre)) {
              celda.innerHTML = `<div class="bg-info text-white border border-info py-1 px-2 rounded btn-actividad" style="cursor:pointer; display:inline-block; min-width:100px;">
                                                                                        <strong>+ Añadir</strong><br>
                                                                                        <small>Actividad</small>
                                                                                    </div>`;
              celda.dataset.estado = '';
            }
          } else {
            // Si ya hay una actividad, aplica el color según su estado
            const colores = estadoColores[estado.toLowerCase().trim()] || {
              bg: 'bg-secondary',
              border: 'border-secondary',
              text: 'text-white'
            };
            contenedorActividad.classList.remove('bg-secondary', 'bg-success', 'bg-danger', 'bg-warning', 'border-secondary', 'border-success', 'border-danger', 'border-warning', 'text-white', 'text-dark', 'bg-info', 'border-info');
            contenedorActividad.classList.add(colores.bg, colores.border, colores.text);
          }
        });
      }

      // Aplica los colores al cargar la página
      aplicarColorInicial();

      // 1. Evento para abrir el modal al hacer clic en el botón de la actividad.
      document.querySelectorAll('.btn-actividad').forEach(btn => {
        btn.addEventListener('click', function() {
          const celda = this.closest('.celda-horario');
          selectedCell = celda;

          const horarioId = celda.dataset.horarioId;
          const dia = celda.dataset.dia;
          const hora = celda.dataset.hora;

          document.getElementById('dia').value = dia;
          document.getElementById('hora').value = hora;
          document.getElementById('horario_id').value = horarioId;
          document.getElementById('subgrupo_id').value = celda.dataset.subgrupoId || '';
          document.getElementById('actividad').value = celda.dataset.nombre || '';
          document.getElementById('estado').value = celda.dataset.estado || 'activo';

          const modal = new bootstrap.Modal(document.getElementById('actividadModal'));
          modal.show();
        });
      });

      // 2. Evento para guardar la actividad.
      document.getElementById('guardarActividad').addEventListener('click', function() {
        const horario_id = document.getElementById('horario_id').value;
        const subgrupo_id = document.getElementById('subgrupo_id').value;
        const actividad = document.getElementById('actividad').value;
        const estado = document.getElementById('estado').value;
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        if (!horario_id || !subgrupo_id || !actividad) {
          Swal.fire({
            icon: 'warning',
            title: 'Faltan datos',
            text: 'Por favor, complete todos los campos.',
            toast: true,
            position: 'bottom-end',
            showConfirmButton: false,
            timer: 3000
          });
          return;
        }

        fetch(guardarUrl, {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({
              horario_id: horario_id,
              subgrupo_id: subgrupo_id,
              actividad: actividad,
              estado: estado,
              _token: csrfToken
            })
          })
          .then(response => {
            if (!response.ok) {
              console.error("Respuesta del servidor no exitosa:", response.status, response.statusText);
              throw new Error('Error en el servidor. Revisa el log de Laravel.');
            }
            return response.json();
          })
          .then(data => {
            console.log("Datos recibidos del servidor:", data);

            if (data.success) {
              // Mapea el estado a las clases de color de Bootstrap
              const estadoRecibido = data.estado ? data.estado.toLowerCase().trim() : '';
              const colores = estadoColores[estadoRecibido] || {
                bg: 'bg-secondary',
                border: 'border-secondary',
                text: 'text-white'
              };

              const grupoSubgrupo = `${data.grupo_nombre} / ${data.subgrupo_nombre}`;

              selectedCell.innerHTML = `
                                            <div class="${colores.bg} ${colores.text} border ${colores.border} py-1 px-2 rounded btn-actividad" 
                                                 style="cursor:pointer; display:inline-block; min-width:100px;">
                                              <strong>${grupoSubgrupo}</strong><br>
                                              <small>${data.fecha}</small><br>
                                              <small>${data.hora_inicio} - ${data.hora_fin}</small>
                                            </div>
                                          `;

              selectedCell.dataset.actividadId = data.id;
              selectedCell.dataset.subgrupoId = subgrupo_id;
              selectedCell.dataset.grupo = data.grupo_nombre;
              selectedCell.dataset.nombre = actividad;
              selectedCell.dataset.estado = estado;
              selectedCell.dataset.horarioId = horario_id;

              Swal.fire({
                icon: 'success',
                title: 'Actividad guardada correctamente',
                toast: true,
                position: 'bottom-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
              });

              const modal = bootstrap.Modal.getInstance(document.getElementById('actividadModal'));
              modal.hide();
            } else {
              Swal.fire({
                icon: 'error',
                title: 'Error',
                text: data.error || 'No se pudo guardar la actividad.',
                toast: true,
                position: 'bottom-end',
                showConfirmButton: false,
                timer: 3000
              });
            }
          })
          .catch(error => {
            console.error('Error guardando actividad:', error);
            Swal.fire({
              icon: 'error',
              title: 'Error de conexión',
              text: error.message || 'Ocurrió un error al intentar comunicarse con el servidor.',
              toast: true,
              position: 'bottom-end',
              showConfirmButton: false,
              timer: 5000
            });
          });
      });
    });
  </script>
  @endpush

  {{-- Incluye las librerías de SweetAlert2 (alertas personalizadas) y otros scripts de Bootstrap. --}}
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="app.js"></script>
  @stack('scripts')
</main>
@endsection