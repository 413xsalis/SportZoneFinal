<?php

namespace Tests\Feature\Colaborador;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Estudiante; // ajusta el namespace de tu modelo

class EstudianteControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function index_muestra_lista_de_estudiantes()
    {
        $user = User::factory()->create();
        Estudiante::factory()->count(3)->create();

        $response = $this->actingAs($user)->get(route('colaborador.estudiantes.index'));

        $response->assertStatus(200);
        $response->assertViewIs('colaborador.estudiantes.index'); // ajusta vista si es diferente
        $response->assertViewHas('estudiantes');
        $response->assertSeeText(Estudiante::first()->nombre); // ajusta el campo real
    }

    /** @test */
    public function store_guarda_un_estudiante()
    {
        $user = User::factory()->create();

        $payload = [
            'nombre' => 'Pedro Gómez',
            'email'  => 'pedro@example.com',
            'telefono' => '3101234567',
            // agrega más campos requeridos en tu migración
        ];

        $response = $this->actingAs($user)->post(route('colaborador.estudiantes.store'), $payload);

        $response->assertRedirect(route('colaborador.estudiantes.index'));
        $this->assertDatabaseHas('estudiantes', [
            'nombre' => 'Pedro Gómez',
            'email'  => 'pedro@example.com',
        ]);
    }

    /** @test */
    public function store_valida_campos_requeridos()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('colaborador.estudiantes.store'), []);

        $response->assertSessionHasErrors(['nombre', 'email']); // ajusta campos
    }

    /** @test */
    public function update_modifica_un_estudiante()
    {
        $user = User::factory()->create();
        $estudiante = Estudiante::factory()->create();

        $response = $this->actingAs($user)->put(
            route('colaborador.estudiantes.update', $estudiante->id),
            ['nombre' => 'Nuevo Nombre', 'email' => 'nuevo@example.com']
        );

        $response->assertRedirect(route('colaborador.estudiantes.index'));
        $this->assertDatabaseHas('estudiantes', ['id' => $estudiante->id, 'nombre' => 'Nuevo Nombre']);
    }

    /** @test */
    public function destroy_elimina_un_estudiante()
    {
        $user = User::factory()->create();
        $estudiante = Estudiante::factory()->create();

        $response = $this->actingAs($user)->delete(route('colaborador.estudiantes.destroy', $estudiante->id));

        $response->assertRedirect(route('colaborador.estudiantes.index'));
        $this->assertDatabaseMissing('estudiantes', ['id' => $estudiante->id]);
    }
}
