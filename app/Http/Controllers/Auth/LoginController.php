<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;




class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        $user = Auth::user();

        // Redirigir al dashboard según el rol
        if ($user->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        }
        if ($user->hasRole('colaborador')) {
            return redirect()->route('colaborador.dashboard');
        }
        if ($user->hasRole('instructor')) {
            return redirect()->route('instructor.dashboard');
        }

        // fallback genérico
        return redirect()->route('home');
    }

    return back()->with('error', 'El usuario o la contraseña son incorrectos.');
}
    public function logout(Request $request)
{
    Auth::logout(); // Esto cierra la sesión

    $request->session()->invalidate(); // Esto invalida completamente la sesión

    $request->session()->regenerateToken(); // Esto regenera el token CSRF para evitar ataques

    return redirect('/login'); // Redirige al usuario a la página de inicio de sesión
}
}
