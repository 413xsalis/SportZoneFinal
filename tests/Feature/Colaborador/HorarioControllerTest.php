<?php

namespace Tests\Feature\Colaborador;

use App\Models\User;
use App\Models\Grupo;
use App\Models\Horario;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HorarioControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $instructor;
    protected $grupo;

    protected function setUp(): void
    {
        parent::setUp();

        // Crear datos base para pruebas
        $this->instructor = User::factory()->create();
        $this->instructor->assignRole('instructor');

        $this->grupo = Grupo::factory()->create();
    }

    /** @test */
    public function puede_listar_horarios()
    {
        Horario::factory()->create([
            'instructor_id' => $this->instructor->id,
            'grupo_id' => $this->grupo->id,
        ]);

        $response = $this->get(route('horarios.index'));

        $response->assertStatus(200);
        $response->assertSee($this->grupo->nombre); // Ajusta según el campo en la vista
    }

    /** @test */
    public function puede_crear_un_horario()
    {
        $data = [
            'instructor_id' => $this->instructor->id,
            'grupo_id' => $this->grupo->id,
            'dia' => 'Lunes',
            'fecha' => now()->toDateString(),
            'hora_inicio' => '08:00',
            'hora_fin' => '10:00',
        ];

        $response = $this->post(route('horarios.store'), $data);

        $response->assertRedirect(route('horarios.index'));
        $this->assertDatabaseHas('horarios', [
            'dia' => 'Lunes',
            'hora_inicio' => '08:00',
            'hora_fin' => '10:00',
        ]);
    }

    /** @test */
    public function puede_actualizar_un_horario()
    {
        $horario = Horario::factory()->create([
            'instructor_id' => $this->instructor->id,
            'grupo_id' => $this->grupo->id,
            'dia' => 'Martes',
        ]);

        $data = [
            'instructor_id' => $this->instructor->id,
            'grupo_id' => $this->grupo->id,
            'fecha' => now()->toDateString(),
            'hora' => '09:00', // según tu validación en update
        ];

        $response = $this->put(route('horarios.update', $horario), $data);

        $response->assertRedirect(route('horarios.index'));
        $this->assertDatabaseHas('horarios', [
            'id' => $horario->id,
            'hora' => '09:00',
        ]);
    }

    /** @test */
    public function puede_eliminar_un_horario()
    {
        $horario = Horario::factory()->create([
            'instructor_id' => $this->instructor->id,
            'grupo_id' => $this->grupo->id,
        ]);

        $response = $this->delete(route('horarios.destroy', $horario));

        $response->assertRedirect(route('horarios.index'));
        $this->assertDatabaseMissing('horarios', ['id' => $horario->id]);
    }
}
