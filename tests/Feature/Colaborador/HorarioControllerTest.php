<?php

namespace Tests\Feature\Colaborador;

use App\Models\User;
use App\Models\Horario;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HorarioControllerTest extends TestCase
{
    use RefreshDatabase; // 🔹 Esto asegura que se ejecuten migraciones antes de cada prueba

    /** @test */
    public function puede_listar_horarios()
    {
        // Crear usuario autenticado
        $user = User::factory()->create();

        // Crear horarios de prueba
        Horario::factory()->count(3)->create();

        // Ejecutar la petición como usuario autenticado
        $response = $this->actingAs($user)->get(route('horarios.index'));

        // Verificar que responde correctamente
        $response->assertStatus(200);
        $response->assertViewHas('horarios');
    }

    /** @test */
    public function puede_crear_horario()
    {
        $user = User::factory()->create();

        $data = [
            'dia' => 'Lunes',
            'hora_inicio' => '08:00',
            'hora_fin' => '10:00',
        ];

        $response = $this->actingAs($user)->post(route('horarios.store'), $data);

        $response->assertRedirect(route('horarios.index'));
        $this->assertDatabaseHas('horarios', $data);
    }

    /** @test */
    public function puede_actualizar_horario()
    {
        $user = User::factory()->create();
        $horario = Horario::factory()->create();

        $data = [
            'dia' => 'Martes',
            'hora_inicio' => '09:00',
            'hora_fin' => '11:00',
        ];

        $response = $this->actingAs($user)->put(route('horarios.update', $horario), $data);

        $response->assertRedirect(route('horarios.index'));
        $this->assertDatabaseHas('horarios', $data);
    }

    /** @test */
    public function puede_eliminar_horario()
    {
        $user = User::factory()->create();
        $horario = Horario::factory()->create();

        $response = $this->actingAs($user)->delete(route('horarios.destroy', $horario));

        $response->assertRedirect(route('horarios.index'));
        $this->assertDatabaseMissing('horarios', ['id' => $horario->id]);
    }
}
