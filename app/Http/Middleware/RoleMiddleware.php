<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class RoleMiddleware
{
    /**
     * Maneja una solicitud entrante.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role  Rol requerido
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        $user = Auth::user();
        if (!$user) {
            // No autenticado, redirigir a login
            return redirect()->route('login');
        }
        // Verifica si el usuario tiene el rol requerido
        if (!$user->hasRole($role)) {
            abort(403, 'User  does not have the right roles.');
        }
        return $next($request);
    }
}