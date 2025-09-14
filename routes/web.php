<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Administrador\AdminController;
use App\Http\Controllers\Administrador\UsuarioController;
use App\Http\Controllers\Administrador\PerfilAdminController;
use App\Http\Controllers\Colaborador\ColaboradorController;
use App\Http\Controllers\Colaborador\EstudianteController;
use App\Http\Controllers\Colaborador\HorarioController;
use App\Http\Controllers\Colaborador\ReporteController;
use App\Http\Controllers\Colaborador\InstructorController;
use App\Http\Controllers\Colaborador\PerfilColabController;
use App\Http\Controllers\Colaborador\PagoController;
use App\Http\Controllers\Instructor\InstrucController;
use App\Http\Controllers\Instructor\AsistenciaController;
use App\Http\Controllers\Instructor\PerfilInstController;
use App\Http\Controllers\Instructor\InstructorHorarioController;
use App\Http\Controllers\Instructor\InstructorReporteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactoController;

// Página principal
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Autenticación
Auth::routes();
Route::group([
    'middleware' => [
        'auth',
        \App\Http\Middleware\PreventBackHistory::class
    ]
], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});



// ========================= ADMIN ========================= //
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'principal'])->name('admin.dashboard');

    // Gestión de usuarios
    Route::get('usuarios/trashed', [UsuarioController::class, 'trashed'])->name('usuarios.trashed');

    Route::resource('usuarios', UsuarioController::class);
    Route::post('usuarios/{id}/restore', [UsuarioController::class, 'restore'])->name('usuarios.restore');
    Route::delete('usuarios/{id}/forceDelete', [UsuarioController::class, 'forceDelete'])->name('usuarios.forceDelete');

    // Vistas adicionales de admin
    Route::get('/gestion', [AdminController::class, 'gestion'])->name('admin.gestion');
    Route::get('/create', [AdminController::class, 'create'])->name('admin.create');
});


// ========================= COLABORADOR ========================= //
Route::prefix('colaborador')->middleware(['auth', 'role:colaborador'])->group(function () {
    Route::get('/dashboard', [ColaboradorController::class, 'principal'])->name('colaborador.dashboard');
    Route::get('/gestion', [ColaboradorController::class, 'gestion'])->name('colaborador.gestion');
    Route::get('/inscripcion', [ColaboradorController::class, 'inscripcion'])->name('colaborador.inscripcion');
    Route::get('/reportes', [ColaboradorController::class, 'reportes'])->name('colaborador.reportes');

    Route::get('instructor/{usuario}', [InstructorController::class, 'show'])->name('instructor.show');


    // Horarios
    Route::resource('horarios', HorarioController::class);

    // Reportes
      Route::get('/reportes/inscripciones', [ReporteController::class, 'reporteInscripciones'])->name('reportes.inscripciones');
    Route::get('/reportes/pagos/pdf', [ReporteController::class, 'pagosPDF'])->name('reportes.pagos.pdf');
    Route::get('/reportes/pagos/excel', [ReporteController::class, 'pagosExcel'])->name('reportes.pagos.excel');

    Route::resource('pagos', PagoController::class);
});




// ========================= INSTRUCTOR ========================= //
Route::prefix('instructor')->middleware(['auth', 'role:instructor'])->group(function () {
    Route::get('/dashboard', [InstrucController::class, 'index'])->name('instructor.dashboard');

    // Horarios
    Route::get('/horario', [InstructorHorarioController::class, 'horario'])->name('instructor.horarios');
    Route::post('/horario/guardar', [InstructorHorarioController::class, 'guardarActividad'])->name('instructor.horarios.guardar');
    Route::put('/horario/{id}', [InstructorHorarioController::class, 'actualizarActividad'])->name('instructor.horarios.actualizar');
    Route::delete('/horario/{id}', [InstructorHorarioController::class, 'eliminarActividad'])->name('instructor.horarios.eliminar');

    // Asistencias
    Route::get('/asistencia', [AsistenciaController::class, 'seleccionarGrupo'])->name('instructor.asistencia');
    Route::post('/asistencia/guardar', [AsistenciaController::class, 'guardar'])->name('instructor.asistencia.guardar');
    Route::get('/asistencia/{grupo_id}', [AsistenciaController::class, 'verSubgrupos'])->name('asistencia.subgrupos'); //Muestra los subgrupos de un grupo seleccionado.
    Route::get('/asistencia/grupo/{nombre}', [AsistenciaController::class, 'tomarAsistenciaPorGrupo'])->name('asistencia.tomar.grupo'); //Permite tomar asistencia a un grupo específico por su nombre.
    Route::post('/subgrupos/store', [AsistenciaController::class, 'storeSubgrupo'])->name('subgrupos.store');

    // Reportes
    Route::get('/reporte/asistencias', [InstructorReporteController::class, 'mostrarReporte'])->name('instructor.reporte.asistencias');
    Route::get('/reporte/asistencias/pdf', [InstructorReporteController::class, 'generarAsistenciasPDF'])->name('instructor.reporte.asistencias.pdf');
    Route::get('/subgrupos/{grupoId}', [InstructorReporteController::class, 'getSubgrupos'])->name('inst.get.subgrupos');



});







// ========================= PERFILES ========================= //
Route::middleware(['auth'])->group(function () {
    // Perfil ADMIN
    Route::prefix('perfil/admin')->name('profile.')->group(function () {
        Route::get('/', [PerfilAdminController::class, 'edit'])->name('edit');
        Route::put('/', [PerfilAdminController::class, 'update'])->name('update');
        Route::post('/upload-document', [PerfilAdminController::class, 'uploadDocument'])->name('uploadDocument');
        Route::post('/upload-logo', [PerfilAdminController::class, 'uploadLogo'])->name('uploadLogo');
        Route::post('/change-password', [PerfilAdminController::class, 'changePassword'])->name('changePassword');
    });

    // Perfil COLABORADOR
    Route::prefix('perfil/colaborador')->name('perfilcolab.')->group(function () {
        Route::get('/', [PerfilColabController::class, 'edit'])->name('edit');
        Route::put('/', [PerfilColabController::class, 'update'])->name('update');
        Route::post('/upload-document', [PerfilColabController::class, 'uploadDocument'])->name('uploadDocument');
        Route::post('/upload-logo', [PerfilColabController::class, 'uploadLogo'])->name('uploadLogo');
        Route::post('/change-password', [PerfilColabController::class, 'changePassword'])->name('changePassword');
    });

    // Perfil INSTRUCTOR
    Route::prefix('perfil/instructor')->name('perfilinst.')->group(function () {
        Route::get('/', [PerfilInstController::class, 'edit'])->name('edit');
        Route::put('/', [PerfilInstController::class, 'update'])->name('update');
        Route::post('/upload-document', [PerfilInstController::class, 'uploadDocument'])->name('uploadDocument');
        Route::post('/upload-logo', [PerfilInstController::class, 'uploadLogo'])->name('uploadLogo');
        Route::post('/change-password', [PerfilInstController::class, 'changePassword'])->name('changePassword');
    });
});





//
Route::prefix('colaborador/pagos')->name('pagos.')->group(function () {
    Route::get('/', [PagoController::class, 'principal'])->name('dashboard');

    // Inscripciones
    Route::get('/inscripciones', [PagoController::class, 'inscripciones'])->name('inscripciones.index');
    Route::post('/inscripciones', [PagoController::class, 'storeInscripcion'])->name('inscripciones.store');

    // Mensualidades
    Route::get('/mensualidades', [PagoController::class, 'mensualidades'])->name('mensualidades.index');
    Route::post('/mensualidades', [PagoController::class, 'storeMensualidad'])->name('mensualidades.store');
    Route::get('/mensualidades/{id}/edit', [PagoController::class, 'edit'])->name('mensualidades.edit');

    // General pagos (opcional: solo si necesitas las rutas CRUD)
    Route::resource('pagos', PagoController::class);

    // SoftDeletes: pagos eliminados y restauración
    Route::get('/eliminados', [PagoController::class, 'eliminados'])->name('eliminados');
    Route::patch('/{id}/restaurar', [PagoController::class, 'restaurar'])->name('restaurar');

});



// ================= ESTUDIANTES =================

// Crear estudiante
Route::get('/estudiantes/create', [EstudianteController::class, 'create'])
    ->name('estudiantes.create');

// Guardar estudiante
Route::post('/inscripcion_estudiante', [EstudianteController::class, 'store'])
    ->name('estudiantes.store');

// Editar estudiante
Route::get('/inscripcion_estudiante/{estudiante:documento}/edit', [EstudianteController::class, 'edit'])
    ->name('estudiantes.edit');

// Actualizar estudiante
Route::put('/inscripcion_estudiante/{estudiante:documento}', [EstudianteController::class, 'update'])
    ->name('estudiantes.update');

// Cambiar estado (activar/inactivar)
Route::patch('/estudiantes/{documento}/cambiar-estado', [EstudianteController::class, 'cambiarEstado'])
    ->name('estudiantes.cambiarEstado');

// Listar estudiantes inactivos
Route::get('/estudiantes/inactivos', [EstudianteController::class, 'inactivos'])
    ->name('estudiantes.inactivos');

Route::get('/colaborador/inscripcion', [EstudianteController::class, 'index'])
    ->name('colaborador.inscripcion');



// ========================= CONTACTO ========================= //
Route::post('/contacto', [ContactoController::class, 'store'])->name('contacto.store');
