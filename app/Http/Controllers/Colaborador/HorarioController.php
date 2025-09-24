<?php

namespace App\Http\Controllers\Colaborador;

use App\Http\Controllers\Controller;
use App\Models\Horario;
use App\Models\Grupo;
use App\Models\User;
use Illuminate\Http\Request;

class HorarioController extends Controller
{
    // Mostrar todos los horarios
    public function index()
    {
        // Cambiar get() por paginate() para horarios
        $horarios = Horario::with(['instructor', 'grupo'])
            ->whereDate('fecha', '>=', now()->toDateString()) // solo fechas de hoy en adelante
            ->orderBy('fecha', 'asc') // más cercanas primero
            ->paginate(10);



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


    public function create()
    {
        $instructores = User::role('instructor')->get(); // Solo usuarios con rol instructor
        $grupos = Grupo::all(); // Todos los grupos

        return view('colaborador.gestion_clases.create', compact('instructores', 'grupos'));
    }

    // Formulario de creación
public function store(Request $request)
{
    $request->validate([
        'instructor_id' => 'required|exists:users,id',
        'grupo_id' => 'required|exists:grupos,id',
        'fecha' => 'required|date|after_or_equal:today',
        'hora_inicio' => 'required|date_format:H:i',
        'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
    ]);

    // Verificar si ya existe un horario con el mismo grupo, instructor y que se solape en la fecha
    $existe = Horario::where('instructor_id', $request->instructor_id)
        ->where('grupo_id', $request->grupo_id)
        ->where('fecha', $request->fecha)
        ->where(function($query) use ($request) {
            $query->whereBetween('hora_inicio', [$request->hora_inicio, $request->hora_fin])
                  ->orWhereBetween('hora_fin', [$request->hora_inicio, $request->hora_fin])
                  ->orWhere(function($q) use ($request) {
                      $q->where('hora_inicio', '<=', $request->hora_inicio)
                        ->where('hora_fin', '>=', $request->hora_fin);
                  });
        })
        ->exists();

    if ($existe) {
        return back()->withErrors([
            'horario' => 'Ya existe un horario para este grupo e instructor en esa fecha y rango de horas.'
        ])->withInput();
    }

    Horario::create($request->all());

    return redirect()->route('horarios.index')->with('success', 'Horario creado correctamente.');
}

    // Mostrar un horario específico
    public function show(Horario $horario)
    {
        return view('colaborador.gestion_clases.show', compact('horario'));
    }

    // Formulario de edición
    public function edit(Horario $horario)
    {
        $instructores = User::role('instructor')->get();
        $grupos = Grupo::all();

        $dias = ['lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sábado', 'domingo']; // Días de la semana

        return view('colaborador.gestion_clases.edit', compact('horario', 'instructores', 'grupos', 'dias'));
    }

    // Actualizar horario
public function update(Request $request, Horario $horario)
{
    $request->validate([
        'instructor_id' => 'required|exists:users,id',
        'grupo_id' => 'required|exists:grupos,id',
        'fecha' => 'required|date|after_or_equal:today',
        'hora_inicio' => 'required|date_format:H:i',
        'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
    ]);

    $existe = Horario::where('instructor_id', $request->instructor_id)
        ->where('grupo_id', $request->grupo_id)
        ->where('fecha', $request->fecha)
        ->where('id', '!=', $horario->id) // excluir el actual
        ->where(function($query) use ($request) {
            $query->whereBetween('hora_inicio', [$request->hora_inicio, $request->hora_fin])
                  ->orWhereBetween('hora_fin', [$request->hora_inicio, $request->hora_fin])
                  ->orWhere(function($q) use ($request) {
                      $q->where('hora_inicio', '<=', $request->hora_inicio)
                        ->where('hora_fin', '>=', $request->hora_fin);
                  });
        })
        ->exists();

    if ($existe) {
        return back()->withErrors([
            'horario' => 'Ya existe un horario para este grupo e instructor en esa fecha y rango de horas.'
        ])->withInput();
    }

    $horario->update($request->all());

    return redirect()->route('horarios.index')->with('success', 'Horario actualizado correctamente.');
}

    // Eliminar horario
    public function destroy(Horario $horario)
    {
        $horario->delete();
        return redirect()->route('horarios.index')->with('success', 'Horario eliminado correctamente');
    }
}