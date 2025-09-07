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
    //public function logout(Request $request)
    //{
      //  auth()->logout();

        //$request->session()->invalidate();   // invalida toda la sesión
        //$request->session()->regenerateToken(); // nuevo token CSRF

        //return redirect('/login');
    //}
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            // Autenticación exitosa
            $request->session()->regenerate();
            return redirect()->intended('/home'); // Redirige a la página principal
        }

        // Autenticación fallida
        return back()->with('error', 'El usuario o la contraseña son incorrectos.');
    }
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    public function logout(Request $request)
{
    Auth::logout(); // Esto cierra la sesión

    $request->session()->invalidate(); // Esto invalida completamente la sesión

    $request->session()->regenerateToken(); // Esto regenera el token CSRF para evitar ataques

    return redirect('/login'); // Redirige al usuario a la página de inicio de sesión
}
}
