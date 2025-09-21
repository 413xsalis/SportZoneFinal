<?php

namespace Tests\Feature\Colaborador;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class ColaboradorControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function index_muestra_la_vista_de_colaboradores()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('colaboradores.index')); 
        // 👆 ajusta al nombre de la ruta que tengas en web.php

        $response->assertStatus(200);
        $response->assertViewIs('colaborador.index'); // 👈 cambia al nombre de tu vista real
    }

    /** @test */
    public function store_guarda_un_nuevo_colaborador()
    {
        $user = User::factory()->create();

        $payload = [
            'nombre' => 'Juan Pérez',
            'email' => 'juan@example.com',
            'telefono' => '3001234567',
            // 👆 agrega los campos obligatorios de tu tabla colaboradores
        ];

        $response = $this->actingAs($user)->post(route('colaboradores.store'), $payload);

        $response->assertRedirect(route('colaboradores.index'));
        $this->assertDatabaseHas('colaboradores', [
            'nombre' => 'Juan Pérez',
            'email' => 'juan@example.com',
        ]);
    }

    /** @test */
    public function destroy_elimina_un_colaborador()
    {
        $user = User::factory()->create();

        // crear colaborador de prueba
        $colaborador = \DB::table('colaboradores')->insertGetId([
            'nombre' => 'Carlos Ramírez',
            'email' => 'carlos@example.com',
            'telefono' => '3007654321',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $response = $this->actingAs($user)->delete(route('colaboradores.destroy', $colaborador));

        $response->assertRedirect(route('colaboradores.index'));
        $this->assertDatabaseMissing('colaboradores', ['id' => $colaborador]);
    }
}
