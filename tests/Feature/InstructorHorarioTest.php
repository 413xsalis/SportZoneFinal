<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Horario;
use App\Models\Actividad;
use App\Models\Subgrupo;
use App\Models\Grupo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;

class InstructorHorarioTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Asegura que la migración de las tablas se ejecuta correctamente.
     * Esto ayuda a depurar el error "no such table".
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        // Verificamos si la tabla asistencias existe después de las migraciones
        if (!Schema::hasTable('asistencias')) {
            $this->fail('La tabla asistencias no se creó. Revisa las migraciones y su orden.');
        }
        if (!Schema::hasTable('horarios')) {
            $this->fail('La tabla horarios no se creó. Revisa las migraciones y su orden.');
        }
    }

    /** @test */
    public function el_metodo_horario_muestra_todos_los_horarios_cuando_no_hay_filtro()
    {
        // Preparar
        $horarios = Horario::factory()->count(10)->create();
        
        // Actuar
        $response = $this->get('/instructor/horario');

        // Verificar
        $response->assertStatus(200);
        $response->assertViewIs('instructor.horario.principal');
        $response->assertViewHas('horarios', function ($horarios) {
            return $horarios->count() === 10;
        });
    }

    /** @test */
    public function el_metodo_horario_filtra_por_instructor_correctamente()
    {
        // Preparar
        $instructor1 = User::factory()->create(['role_id' => 2]);
        $instructor2 = User::factory()->create(['role_id' => 2]);
        Horario::factory()->count(5)->create(['instructor_id' => $instructor1->id]);
        Horario::factory()->count(3)->create(['instructor_id' => $instructor2->id]);

        // Actuar
        $response = $this->get("/instructor/horario?instructorId={$instructor1->id}");

        // Verificar
        $response->assertStatus(200);
        $response->assertViewHas('horarios', function ($horarios) use ($instructor1) {
            return $horarios->count() === 5 && $horarios->every(fn ($h) => $h->instructor_id === $instructor1->id);
        });
    }

    /** @test */
    public function el_metodo_obtener_actividades_devuelve_json_correcto()
    {
        // Preparar
        $actividad = Actividad::factory()->create();

        // Actuar
        $response = $this->get('/instructor/actividades');

        // Verificar
        $response->assertStatus(200);
        $response->assertJson([
            [
                'id' => $actividad->id,
                'nombre' => $actividad->actividad,
                'horario_id' => $actividad->horario_id,
            ]
        ]);
        $response->assertJsonCount(1);
    }
    
    /** @test */
    public function el_metodo_guardar_actividad_crea_una_nueva_actividad_con_exito()
    {
        // Preparar
        $horario = Horario::factory()->create();
        $subgrupo = Subgrupo::factory()->create();
        $datos = [
            'horario_id' => $horario->id,
            'subgrupo_id' => $subgrupo->id,
            'actividad' => 'Clase de Prueba',
            'estado' => 'activo'
        ];

        // Actuar
        $response = $this->postJson('/instructor/actividades', $datos);

        // Verificar
        $response->assertStatus(200);
        $response->assertJson(['success' => true]);
        $this->assertDatabaseHas('actividads', ['actividad' => 'Clase de Prueba']);
    }

    /** @test */
    public function el_metodo_guardar_actividad_valida_los_datos_requeridos()
    {
        // Preparar
        $datosInvalidos = [
            'horario_id' => null,
            'subgrupo_id' => null,
            'actividad' => '',
            'estado' => ''
        ];

        // Actuar
        $response = $this->postJson('/instructor/actividades', $datosInvalidos);

        // Verificar
        $response->assertStatus(422); // HTTP 422 Unprocessable Entity
        $response->assertJsonValidationErrors(['horario_id', 'subgrupo_id', 'actividad', 'estado']);
    }

    /** @test */
    public function el_metodo_actualizar_actividad_actualiza_correctamente()
    {
        // Preparar
        $actividad = Actividad::factory()->create(['actividad' => 'Actividad Antigua']);
        $datosActualizados = ['actividad' => 'Actividad Nueva', 'estado' => 'cancelado'];

        // Actuar
        $response = $this->putJson("/instructor/actividades/{$actividad->id}", $datosActualizados);

        // Verificar
        $response->assertStatus(200);
        $response->assertJson(['success' => true]);
        $this->assertDatabaseHas('actividads', ['id' => $actividad->id, 'actividad' => 'Actividad Nueva', 'estado' => 'cancelado']);
    }

    /** @test */
    public function el_metodo_eliminar_actividad_elimina_correctamente()
    {
        // Preparar
        $actividad = Actividad::factory()->create();

        // Actuar
        $response = $this->deleteJson("/instructor/actividades/{$actividad->id}");

        // Verificar
        $response->assertStatus(200);
        $response->assertJson(['success' => true]);
        $this->assertDatabaseMissing('actividads', ['id' => $actividad->id]);
    }
}