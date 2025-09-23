<?php

namespace Tests\Feature;

use App\Models\Grupo;
use App\Models\Subgrupo;
use Spatie\Permission\Models\Role;

use Tests\TestCase;
use App\Models\User;
use App\Models\Estudiante;
use App\Models\Horario;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Carbon\Carbon;

class AdminControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function la_pagina_principal_del_admin_muestra_los_datos_correctos()
    {

        // Crear grupo y subgrupo para las FK
    $grupo = Grupo::factory()->create();
    $subgrupo = Subgrupo::factory()->create(['grupo_id' => $grupo->id]);

        // Crear el rol admin si no existe
        Role::firstOrCreate(['name' => 'admin']);

        // Crear datos de prueba
        $estudiantes = Estudiante::factory()->count(5)->create([
            'grupo_id' => $grupo->id,
            'id_subgrupo' => $subgrupo->id,
        ]);
        $instructores = User::factory()->count(3)->create();

        // Crear clases para hoy
        $horario = Horario::factory()->create([
            'fecha' => Carbon::now()->format('Y-m-d'),
        ]);

        // Simular un usuario autenticado con rol admin
    $admin = User::factory()->create();
    $admin->assignRole('admin');
    $this->actingAs($admin);

        // Llamar a la ruta (ajústala al nombre real de tu ruta)
        $response = $this->get(route('admin.dashboard')); 
        // Si no tienes ruta nombrada, usa $this->get('/ruta-que-llama-al-index');

        // Verificar que carga la vista
        $response->assertStatus(200);
        $response->assertViewIs('administrador.admin.principal');

        // Verificar que pasa las variables correctas
        $response->assertViewHas('totalAlumnos', Estudiante::count());
        $response->assertViewHas('totalUsers', User::count());
        $response->assertViewHas('clasesHoyCount', Horario::whereDate('fecha', now()->format('Y-m-d'))->count());
        $response->assertViewHas('instructores', function($instructores) {
            return $instructores instanceof \Illuminate\Support\Collection;
        });
    }

    /** @test */
    public function la_pagina_de_crear_usuario_se_carga_correctamente()
    {

    // Crear el rol admin si no existe
    Role::firstOrCreate(['name' => 'admin']);
    $admin = User::factory()->create();
    $admin->assignRole('admin');
    $this->actingAs($admin);

        $response = $this->get(route('admin.create')); // Ajusta la ruta al nombre real
        $response->assertStatus(200);
        $response->assertViewIs('administrador.Gestion_usuarios.create');
    }

    /** @test */
    public function la_pagina_de_gestion_muestra_los_usuarios_correctamente()
    {

    // Crear el rol admin si no existe
    Role::firstOrCreate(['name' => 'admin']);
    $admin = User::factory()->create();
    $admin->assignRole('admin');
    $this->actingAs($admin);

        $response = $this->get(route('admin.gestion')); // Ajusta la ruta al nombre real
        $response->assertStatus(200);
        $response->assertViewIs('administrador.Gestion_usuarios.principal');
        $response->assertViewHasAll(['users', 'totalUsers', 'activeUsers', 'inactiveUsers']);
    }
}
