<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        $user = Auth::user();

        if (!$user) {
            // No autenticado → login
            return redirect()->route('login');
        }

        // Si no tiene el rol correcto, redirigir al dashboard que sí le corresponda
        if (!$user->hasRole($role)) {
            if ($user->hasRole('admin')) {
                return redirect()->route('admin.dashboard');
            }
            if ($user->hasRole('colaborador')) {
                return redirect()->route('colaborador.dashboard');
            }
            if ($user->hasRole('instructor')) {
                return redirect()->route('instructor.dashboard');
            }

            // fallback por si acaso
            return redirect()->route('home');
        }

        return $next($request);
    }
}
