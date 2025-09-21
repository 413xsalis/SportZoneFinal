<?php

namespace Tests\Feature\Colaborador;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Estudiante;
use App\Models\Grupo;

class EstudianteControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function puede_listar_estudiantes_activos()
    {
        Grupo::factory()->create();
        Estudiante::factory()->count(3)->create(['estado' => 1]);

        $response = $this->get(route('colaborador.inscripcion'));

        $response->assertStatus(200);
        $response->assertViewHas('estudiantes');
    }

    /** @test */
    public function puede_mostrar_el_formulario_de_creacion()
    {
        $response = $this->get(route('estudiantes.create'));

        $response->assertStatus(200);
        $response->assertViewHasAll(['grupos', 'subgrupos']);
    }

    /** @test */
    public function puede_registrar_un_estudiante()
    {
        $grupo = Grupo::factory()->create();

        $data = Estudiante::factory()->make([
            'grupo_id' => $grupo->id,
        ])->toArray();

        $response = $this->post(route('estudiantes.store'), $data);

        $response->assertRedirect(route('colaborador.inscripcion'));
        $this->assertDatabaseHas('estudiantes', [
            'documento' => $data['documento'],
            'nombre_1' => $data['nombre_1'],
        ]);
    }

    /** @test */
    public function puede_mostrar_el_formulario_de_edicion()
    {
        $grupo = Grupo::factory()->create();
        $estudiante = Estudiante::factory()->create(['grupo_id' => $grupo->id]);

        $response = $this->get(route('estudiantes.edit', $estudiante->id));

        $response->assertStatus(200);
        $response->assertViewHas('estudiante');
    }

    /** @test */
    public function puede_actualizar_un_estudiante()
    {
        $grupo = Grupo::factory()->create();
        $estudiante = Estudiante::factory()->create(['grupo_id' => $grupo->id]);

        $response = $this->put(route('estudiantes.update', $estudiante->id), [
            'documento' => $estudiante->documento,
            'nombre_1' => 'Nuevo Nombre',
            'nombre_2' => $estudiante->nombre_2,
            'apellido_1' => $estudiante->apellido_1,
            'apellido_2' => $estudiante->apellido_2,
            'grupo_id' => $grupo->id,
        ]);

        $response->assertRedirect(route('colaborador.inscripcion'));
        $this->assertDatabaseHas('estudiantes', ['nombre_1' => 'Nuevo Nombre']);
    }

    /** @test */
    public function puede_cambiar_el_estado_de_un_estudiante()
    {
        $estudiante = Estudiante::factory()->create(['estado' => 1]);

        $response = $this->patch(route('estudiantes.cambiarEstado', $estudiante->documento));

        $response->assertRedirect();
        $this->assertDatabaseHas('estudiantes', ['id' => $estudiante->id, 'estado' => 0]);
    }

    /** @test */
    public function puede_listar_estudiantes_inactivos()
    {
        Grupo::factory()->create();
        Estudiante::factory()->count(2)->create(['estado' => 0]);

        $response = $this->get(route('estudiantes.inactivos'));

        $response->assertStatus(200);
        $response->assertViewHas('inactivos');
    }
}
