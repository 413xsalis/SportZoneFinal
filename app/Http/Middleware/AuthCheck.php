<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthCheck
{
    /**
     * Manejar una petición entrante.
     */
    public function handle(Request $request, Closure $next)
    {
        // si NO hay usuario logueado
        if (!Auth::check()) {
            return redirect()->route('login'); // cambia 'login' si tu ruta es diferente
        }

        return $next($request);
    }
}
