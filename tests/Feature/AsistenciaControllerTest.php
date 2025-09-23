<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Grupo;
use App\Models\Subgrupo;
use App\Models\Estudiante;
use App\Models\Asistencia;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Carbon\Carbon;

class AsistenciaControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function el_metodo_asistencia_carga_la_vista_correctamente()
    {
        $response = $this->get('/instructor/asistencia');
        $response->assertStatus(200);
        $response->assertViewIs('instructor.asistencia.principal');
    }

    /** @test */
    public function el_metodo_verSubgrupos_muestra_subgrupos_de_un_grupo()
    {
        // Prepara los datos
        $grupo = Grupo::factory()->create();
        Subgrupo::factory()->count(3)->create(['grupo_id' => $grupo->id]);

        // Actúa
        $response = $this->get("/instructor/asistencia/subgrupos/{$grupo->id}");

        // Verifica
        $response->assertStatus(200);
        $response->assertViewIs('instructor.asistencia.subgrupos');
        $response->assertViewHas('subgrupos', function ($subgrupos) {
            return $subgrupos->count() === 3;
        });
    }

    /** @test */
    public function el_metodo_tomarAsistenciaPorSubgrupo_muestra_estudiantes()
    {
        // Prepara los datos
        $subgrupo = Subgrupo::factory()->has(Estudiante::factory()->count(5))->create();

        // Actúa
        $response = $this->get("/instructor/asistencia/tomar-asistencia/subgrupo/{$subgrupo->id}");

        // Verifica
        $response->assertStatus(200);
        $response->assertViewIs('instructor.asistencia.tomar.subgrupo');
        $response->assertViewHas('subgrupo', function ($viewSubgrupo) use ($subgrupo) {
            return $viewSubgrupo->id === $subgrupo->id && $viewSubgrupo->estudiantes->count() === 5;
        });
    }

    /** @test */
    public function el_metodo_guardar_crea_o_actualiza_asistencias_correctamente()
    {
        // Prepara los datos
        $subgrupo = Subgrupo::factory()->create();
        $estudiantes = Estudiante::factory()->count(2)->create(['subgrupo_id' => $subgrupo->id]);
        $documentos = $estudiantes->pluck('documento');
        $fecha = Carbon::today()->toDateString();

        $datos = [
            'subgrupo_id' => $subgrupo->id,
            'fecha' => $fecha,
            'asistencia' => [
                $documentos[0] => 'presente',
                $documentos[1] => 'ausente'
            ]
        ];

        // Actúa
        $response = $this->post(route('asistencia.guardar'), $datos);

        // Verifica
        $response->assertStatus(302); // 302 es una redirección
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('asistencias', [
            'estudiante_documento' => $documentos[0],
            'fecha' => $fecha,
            'estado' => 'presente'
        ]);
        $this->assertDatabaseHas('asistencias', [
            'estudiante_documento' => $documentos[1],
            'fecha' => $fecha,
            'estado' => 'ausente'
        ]);
    }
    
    /** @test */
    public function el_metodo_guardar_muestra_error_con_datos_invalidos()
    {
        // Actúa con datos faltantes
        $response = $this->post(route('asistencia.guardar'), [
            'subgrupo_id' => null,
            'fecha' => null,
            'asistencia' => []
        ]);

        // Verifica
        $response->assertStatus(302); // Redirige con errores de validación
        $response->assertSessionHasErrors(['subgrupo_id', 'fecha', 'asistencia']);
    }

    /** @test */
    public function el_metodo_reporteAsistencias_filtra_por_subgrupo()
    {
        // Prepara los datos
        $subgrupo1 = Subgrupo::factory()->create();
        $subgrupo2 = Subgrupo::factory()->create();
        Asistencia::factory()->count(5)->create(['subgrupo_id' => $subgrupo1->id]);
        Asistencia::factory()->count(3)->create(['subgrupo_id' => $subgrupo2->id]);

        // Actúa
        $response = $this->get('/instructor/reporte?subgrupo=' . $subgrupo1->id);

        // Verifica
        $response->assertStatus(200);
        $response->assertViewIs('instructor.reporte.principal');
        $response->assertViewHas('asistencias', function ($asistencias) use ($subgrupo1) {
            return $asistencias->count() === 5 && $asistencias->every(fn ($a) => $a->subgrupo_id === $subgrupo1->id);
        });
    }

    /** @test */
    public function el_metodo_eventosDelDia_devuelve_asistencias_correctas()
    {
        // Prepara los datos
        $fecha = '2025-09-23';
        Asistencia::factory()->count(4)->create(['fecha' => $fecha]);
        Asistencia::factory()->count(2)->create(['fecha' => Carbon::yesterday()->toDateString()]);

        // Actúa
        $response = $this->get("/instructor/eventos/{$fecha}");

        // Verifica
        $response->assertStatus(200);
        $response->assertViewHas('asistenciasHoy', function ($asistencias) use ($fecha) {
            return $asistencias->count() === 4 && $asistencias->every(fn ($a) => Carbon::parse($a->fecha)->toDateString() === $fecha);
        });
    }
    
    /** @test */
    public function el_metodo_storeSubgrupo_crea_un_nuevo_subgrupo()
    {
        // Prepara los datos
        $grupo = Grupo::factory()->create();
        $datos = [
            'nombre' => 'Subgrupo de prueba',
            'grupo_id' => $grupo->id,
        ];
        
        // Actúa
        $response = $this->post(route('asistencia.subgrupos.store'), $datos);

        // Verifica
        $response->assertStatus(302);
        $response->assertSessionHas('success', 'Subgrupo creado correctamente.');
        $this->assertDatabaseHas('subgrupos', ['nombre' => 'Subgrupo de prueba', 'grupo_id' => $grupo->id]);
    }
}
