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
    $horarios = Horario::with(['instructor', 'grupo'])->paginate(10);
    
    // Estos pueden mantenerse como colecciones
    $instructores = User::role('instructor')->get();
    $grupos = Grupo::all();
    
    // Calcular próximas clases
    $proximasClases = Horario::where('fecha', '>=', now()->format('Y-m-d'))->count();

    return view('colaborador.gestion_clases.principal', 
        compact('horarios', 'instructores', 'grupos', 'proximasClases'));
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
            'dia' => 'required|string',
            'fecha' => 'required|date',
            'hora_inicio' => 'required',
            'hora_fin' => 'required',
        ]);

        Horario::create([
            'instructor_id' => $request->instructor_id,
            'grupo_id' => $request->grupo_id,
            'dia' => $request->dia,
            'fecha' => $request->fecha,
            'hora_inicio' => $request->hora_inicio,
            'hora_fin' => $request->hora_fin,
        ]);
        return redirect()->route('horarios.index')->with('success', 'Horario creado correctamente');
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
        return view('colaborador.gestion_clases.edit', compact('horario', 'instructores', 'grupos'));
    }

    // Actualizar horario
    public function update(Request $request, Horario $horario)
    {
        $request->validate([
            'instructor_id' => 'required|exists:users,id',
            'grupo_id' => 'required|exists:grupos,id',
            'fecha' => 'required|date',
            'hora_inicio' => 'required',
            'hora_fin' => 'required',
        ]);

        $horario->update($request->all());

        return redirect()->route('horarios.index')->with('success', 'Horario actualizado correctamente');
    }

    // Eliminar horario
    public function destroy(Horario $horario)
    {
        $horario->delete();
        return redirect()->route('horarios.index')->with('success', 'Horario eliminado correctamente');
    }
}