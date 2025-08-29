<?php

namespace App\Http\Controllers\Colaborador;

use App\Http\Controllers\Controller;
use App\Models\User;


class InstructorController extends Controller
{
    public function index()
    {
        // Obtener usuarios con rol de instructor
        $instructores = User::role('instructor')->get();
        
        return view('colaborador.inicio_colab.principal', compact('instructores'));
    }
}