<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Models\Actividad;
use App\Models\User;
use App\Models\Asistencia;
use Carbon\Carbon;

class InstrucController extends Controller
{
public function index()
{
    //estadísticas
    $clasesActivas = Actividad::where('estado', 'activo')->count();
    $clasesPendientes = Actividad::where('estado', 'pendiente')->count();
    $clasesCanceladas = Actividad::where('estado', 'cancelado')->count();
    $totalInstructores = User::role('Instructor')->count();

    //asistencias de hoy
$asistenciasHoy = Asistencia::with([
        'estudiante',
        'subgrupo.grupo' // 👈 así cargamos el grupo padre del subgrupo
    ])
    ->whereDate('created_at', Carbon::today())
    ->latest()
    ->take(10)
    ->get();

    return view('instructor.inicio.principal', compact(
        'clasesActivas',
        'clasesPendientes',
        'clasesCanceladas',
        'totalInstructores',
        'asistenciasHoy'
    ));
}
}
