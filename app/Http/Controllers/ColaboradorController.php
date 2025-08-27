<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Horario;
use App\Models\Grupo;
use App\Models\Estudiante;
use App\Models\User;
use Spatie\Permission\Models\Role;

class ColaboradorController extends Controller
{
    public function index()
    {
        // Obtener solo usuarios con rol de instructor CON PAGINACIÓN
        $instructores = User::role('instructor')->paginate(10); // 10 elementos por página
        return view('colaborador.inicio_colab.principal', compact('instructores'));
    }

    public function principal()
    {
        // Obtener solo usuarios con rol de instructor CON PAGINACIÓN
        $instructores = User::role('instructor')->paginate(10); // 10 elementos por página
        return view('colaborador.inicio_colab.principal', compact('instructores'));
    }

    public function gestion()
    {
        // Cambiar get() por paginate() para horarios
        $horarios = Horario::with(['instructor', 'grupo'])->paginate(10);

        // Estos pueden mantenerse como colecciones
        $instructores = User::role('instructor')->get();
        $grupos = Grupo::all();

        // Calcular próximas clases
        $proximasClases = Horario::where('fecha', '>=', now()->format('Y-m-d'))->count();

        return view(
            'colaborador.gestion_clases.principal',
            compact('horarios', 'instructores', 'grupos', 'proximasClases')
        );
    }
    public function inscripcion()
    {
        $estudiantes = Estudiante::with('grupo')->paginate(10); // Cambia all() por paginate()
        $grupos = Grupo::all();

        return view('colaborador.inscripcion_estudent.principal', compact('estudiantes', 'grupos'));
    }

    public function reportes()
    {
        return view('colaborador.reportes.principal');
    }
}