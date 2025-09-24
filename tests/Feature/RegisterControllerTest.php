<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Spatie\Permission\Models\Role;

class RegisterControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Crear roles necesarios para la prueba
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'instructor']);
        Role::create(['name' => 'colaborador']);
    }

    /** @test */
    public function first_registered_user_gets_admin_role_and_redirects_to_admin_dashboard()
    {
        $response = $this->post('/register', [
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $user = User::first();

        // Verificar que el usuario fue creado
        $this->assertNotNull($user);
        $this->assertEquals('admin@example.com', $user->email);

        // Verificar que tiene rol admin
        $this->assertTrue($user->hasRole('admin'));

        // Verificar redirección a ruta admin.dashboard
        $response->assertRedirect(route('admin.dashboard'));

        // Verificar que el usuario está autenticado
        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function second_registered_user_gets_instructor_role_and_redirects_to_instructor_dashboard()
    {
        // Crear primer usuario para que no sea el primero
        User::factory()->create();

        $response = $this->post('/register', [
            'name' => 'Instructor User',
            'email' => 'instructor@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $user = User::where('email', 'instructor@example.com')->first();

        $this->assertNotNull($user);

        // Verificar que tiene rol instructor
        $this->assertTrue($user->hasRole('instructor'));

        // Verificar redirección a ruta instructor.dashboard
        $response->assertRedirect(route('instructor.dashboard'));

        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function registration_fails_with_invalid_data()
    {
        $response = $this->post('/register', [
            'name' => '', // nombre vacío
            'email' => 'not-an-email',
            'password' => 'short',
            'password_confirmation' => 'different',
        ]);

        $response->assertSessionHasErrors(['name', 'email', 'password']);
        $this->assertGuest();
    }
}
