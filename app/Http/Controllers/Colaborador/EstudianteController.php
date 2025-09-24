<?php

namespace App\Http\Controllers\Colaborador;
use Illuminate\Http\Request;
use App\Models\Estudiante;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use App\Models\Grupo;
use App\Models\Subgrupo;

class EstudianteController extends Controller
{


    public function index()
    {
        $estudiantes = Estudiante::with('grupo')
            ->where('estado', 1)  // Filtrar solo estudiantes activos
            ->orderBy('created_at', 'desc') // Últimos primero
            ->paginate(10);


        $grupos = Grupo::all(); // Asegúrate de obtener los grupos

        return view('colaborador.inscripcion_estudent.principal', compact('estudiantes', 'grupos'));

    }

    public function create()
    {
        $grupos = Grupo::all();
        $subgrupos = Subgrupo::all(); // todos los subgrupos

        return view('colaborador.inscripcion_estudent.create', compact('grupos', 'subgrupos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'documento' => 'required|digits:10|unique:estudiantes,documento',
            'nombre_1' => 'required|string|max:255',
            'nombre_2' => 'nullable|string|max:255',
            'apellido_1' => 'required|string|max:255',
            'apellido_2' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'nombre_contacto' => 'nullable|string|max:255',
            'telefono_contacto' => 'nullable|string|max:20',
            'eps' => 'nullable|string|max:255',
            'grupo_id' => 'required|exists:grupos,id',
            'id_subgrupo' => 'nullable|exists:subgrupos,id',
        ], [
            'documento.required' => 'El campo Documento es obligatorio.',
            'documento.digits' => 'El Documento debe tener exactamente 10 dígitos.',
            'documento.unique' => 'Este Documento ya está registrado.',
            'nombre_1.required' => 'El Primer Nombre es obligatorio.',
            'apellido_1.required' => 'El Primer Apellido es obligatorio.',
            'telefono.max' => 'El Teléfono no puede superar los 20 caracteres.',
            'telefono_contacto.max' => 'El Teléfono de Contacto no puede superar los 20 caracteres.',
            'grupo_id.required' => 'Debes seleccionar un Grupo.',
            'grupo_id.exists' => 'El Grupo seleccionado no es válido.',
            'id_subgrupo.exists' => 'El Subgrupo seleccionado no es válido.',
        ]);

        Estudiante::create($request->only([
            'documento',
            'nombre_1',
            'nombre_2',
            'apellido_1',
            'apellido_2',
            'telefono',
            'nombre_contacto',
            'telefono_contacto',
            'eps',
            'grupo_id',
            'id_subgrupo',
        ]));

        return redirect()->route('colaborador.inscripcion')
            ->with('success', 'Usuario creado exitosamente.');
    }

    public function edit(Estudiante $estudiante)
    {
        $grupos = Grupo::all();
        return view('colaborador.inscripcion_estudent.editar', compact('estudiante', 'grupos'));
    }

    public function update(Request $request, Estudiante $estudiante)
    {
        $validated = $request->validate([
            'documento' => [
                'required',
                'digits:10',
                Rule::unique('estudiantes')->ignore($estudiante->documento, 'documento'),
            ],
            'nombre_1' => 'required|string|max:255',
            'nombre_2' => 'nullable|string|max:255',
            'apellido_1' => 'required|string|max:255',
            'apellido_2' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'nombre_contacto' => 'nullable|string|max:255',
            'telefono_contacto' => 'nullable|string|max:20',
            'eps' => 'nullable|string|max:255',
            'grupo_id' => 'required|exists:grupos,id',
        ], [
            'documento.required' => 'El campo Documento es obligatorio.',
            'documento.digits' => 'El Documento debe tener exactamente 10 dígitos.',
            'documento.unique' => 'Este Documento ya está registrado.',
            'nombre_1.required' => 'El Primer Nombre es obligatorio.',
            'apellido_1.required' => 'El Primer Apellido es obligatorio.',
            'telefono.max' => 'El Teléfono no puede superar los 20 caracteres.',
            'telefono_contacto.max' => 'El Teléfono de Contacto no puede superar los 20 caracteres.',
            'grupo_id.required' => 'Debes seleccionar un Grupo.',
            'grupo_id.exists' => 'El Grupo seleccionado no es válido.',
        ]);

        $estudiante->update($validated);

        return redirect()->route('colaborador.inscripcion')
            ->with('success', '✅ Estudiante actualizado correctamente.');
    }


    public function cambiarEstado($documento)
    {
        $estudiante = Estudiante::where('documento', $documento)->firstOrFail();

        // Alternar entre activo (1) e inactivo (0)
        $estudiante->estado = $estudiante->estado ? 0 : 1;
        $estudiante->save();

        return back()->with('success', 'Estado del estudiante actualizado correctamente.');
    }


    public function inactivos()
    {
        $inactivos = Estudiante::with('grupo')
            ->where('estado', 0)  // Filtrar solo estudiantes inactivos
            ->paginate(10);

        $grupos = Grupo::all();

        return view('colaborador.inscripcion_estudent.inactivos', compact('inactivos', 'grupos'));
    }



}




