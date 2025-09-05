<?php

namespace App\Http\Controllers\Colaborador;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class InstructorController extends Controller
{
    public function index()
    {
        // Obtener usuarios con rol de instructor
        $instructores = User::role('instructor')->get();
        
        return view('colaborador.inicio_colab.principal', compact('instructores'));
    }

        public function show(User $usuario)
    {
        // Los roles del usuario se pueden acceder directamente a través de $usuario->roles
        // gracias al trait HasRoles. Puedes cargarlos explícitamente si es necesario.
        $usuario->load('roles');
        return view('colaborador.inicio_colab.show', compact('usuario'));
    }



}