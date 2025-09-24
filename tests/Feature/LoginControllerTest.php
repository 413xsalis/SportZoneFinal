<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class LoginControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_login_with_correct_credentials()
    {
        // Crear usuario con contraseña conocida
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password123'),
        ]);

        // Hacer petición POST a la ruta de login
        $response = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'password123',
        ]);

        // Verificar que redirige a /home
        $response->assertRedirect('/home');

        // Verificar que el usuario está autenticado
        $this->assertAuthenticatedAs($user);
    }

    public function test_user_cannot_login_with_wrong_credentials()
    {
        // Crear usuario
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password123'),
        ]);

        // Intentar login con contraseña incorrecta
        $response = $this->from('/login')->post('/login', [
            'email' => 'test@example.com',
            'password' => 'wrongpassword',
        ]);

        // Verificar que vuelve a la página de login
        $response->assertRedirect('/login');

        // Verificar que muestra el mensaje de error en sesión
        $response->assertSessionHas('error', 'El usuario o la contraseña son incorrectos.');

        // Verificar que no está autenticado
        $this->assertGuest();
    }

    public function test_authenticated_user_can_logout()
    {
        // Crear usuario y autenticarlo
        $user = User::factory()->create();

        $this->actingAs($user);

        // Hacer petición POST a logout
        $response = $this->post('/logout');

        // Verificar que redirige a /login
        $response->assertRedirect('/login');

        // Verificar que el usuario ya no está autenticado
        $this->assertGuest();
    }
}
