<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Actividad;
use App\Models\Asistencia;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Carbon\Carbon;

class InstrucTest extends TestCase
{
    // Utiliza RefreshDatabase para una base de datos limpia para cada prueba.
    use RefreshDatabase;

    /** @test */
    public function el_metodo_index_carga_la_vista_con_los_datos_correctos()
    {
        // 1. PREPARAR (ARRANGE)
        // Crea los datos de prueba en la base de datos.
        User::factory()->count(5)->create(['role_id' => 2]); // Crea 5 instructores
        Actividad::factory()->count(2)->create(['estado' => 'activo']); // 2 actividades activas
        Actividad::factory()->count(3)->create(['estado' => 'pendiente']); // 3 actividades pendientes
        Actividad::factory()->count(1)->create(['estado' => 'cancelado']); // 1 actividad cancelada
        
        // Crea 10 asistencias de hoy y algunas de ayer para asegurar el filtro de fecha.
        Asistencia::factory()->count(10)->create();
        Asistencia::factory()->count(5)->create(['created_at' => Carbon::yesterday()]);

        // 2. ACTUAR (ACT)
        // Simula una petición GET a la ruta principal del instructor.
        $response = $this->get('/instructor/inicio');

        // 3. VERIFICAR (ASSERT)
        // Confirma que la respuesta es exitosa (código 200).
        $response->assertStatus(200);

        // Verifica que la vista correcta fue devuelta.
        $response->assertViewIs('instructor.inicio.principal');
        
        // Comprueba que las variables pasadas a la vista tienen los valores correctos.
        $response->assertViewHas('clasesActivas', 2);
        $response->assertViewHas('clasesPendientes', 3);
        $response->assertViewHas('clasesCanceladas', 1);
        $response->assertViewHas('totalInstructores', 5);
        
        // Valida que el listado de asistencias de hoy contiene 10 elementos.
        $response->assertViewHas('asistenciasHoy', function ($asistencias) {
            return $asistencias->count() === 10;
        });
    }
}