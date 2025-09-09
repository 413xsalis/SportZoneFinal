<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(): RedirectResponse
    {
        $usuario = Auth::user();

        if ($usuario->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        } elseif ($usuario->hasRole('colaborador')) {
            return redirect()->route('colaborador.dashboard');
        } elseif ($usuario->hasRole('instructor')) {
            return redirect()->route('instructor.dashboard');
        }

        // Si el usuario no tiene ninguno de los roles anteriores,
        // lo redirigimos a la página de bienvenida.
        return redirect()->route('welcome');
    }
}