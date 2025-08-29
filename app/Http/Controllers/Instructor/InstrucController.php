<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Models\Asistencia;
use Carbon\Carbon;

class InstrucController extends Controller
{
   public function index()
    {
        // Obtiene las asistencias del día actual
        $asistenciasHoy = Asistencia::whereDate('fecha', Carbon::today())
                                    ->with(['estudiante', 'subgrupo'])
                                    ->get();

        // Pasa únicamente las asistencias de hoy a la vista
        return view('instructor.inicio.principal', compact('asistenciasHoy'));
    }

}
