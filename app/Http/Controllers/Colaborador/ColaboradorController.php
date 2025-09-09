<?php

namespace App\Http\Controllers\Colaborador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Horario;
use App\Models\Grupo;
use App\Models\Estudiante;
use App\Models\User;


class ColaboradorController extends Controller
{
    public function index()
    {
        // Obtener solo usuarios con rol de instructor CON PAGINACIÓN
        $instructores = User::role('instructor')->withTrashed()->paginate(10);
        $totalInstructores = User::role('instructor')->withTrashed()->count();
        $instructoresActivos = User::role('instructor')->whereNull('deleted_at')->count();
        $instructoresInactivos = User::role('instructor')->onlyTrashed()->count();
        $nuevosEsteMes = User::role('instructor')->where('created_at', '>=', now()->subDays(30))->count();

        return view('colaborador.inicio_colab.principal', compact(
            'instructores',
            'totalInstructores',
            'instructoresActivos',
            'instructoresInactivos',
            'nuevosEsteMes'
        ));

    }

    public function principal()
    {
        // Obtener todos los usuarios con el rol 'instructor' y paginarlos
        $instructores = User::role('instructor')->paginate(10); // Puedes ajustar el número (10)

        // Contadores para los stats cards
        $todosInstructores = User::role('instructor')->get();
        $totalInstructores = $todosInstructores->count();
        $instructoresActivos = $todosInstructores->where('deleted_at', null)->count();
        $instructoresInactivos = $todosInstructores->whereNotNull('deleted_at')->count();
        $nuevosEsteMes = $todosInstructores->where('created_at', '>=', now()->startOfMonth())->count();

        return view('colaborador.inicio_colab.principal', compact('instructores', 'totalInstructores', 'instructoresActivos', 'instructoresInactivos', 'nuevosEsteMes'));
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