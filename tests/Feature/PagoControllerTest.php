<?php

namespace Tests\Feature\Colaborador;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Pago; // ajusta namespace si lo tienes en otro módulo

class PagoControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function index_muestra_lista_de_pagos()
    {
        $user = User::factory()->create();
        Pago::factory()->count(3)->create();

        $response = $this->actingAs($user)->get(route('pagos.dashboard')); 
        // 👆 ajusta el nombre de la ruta según tu web.php

        $response->assertStatus(200);
        $response->assertViewIs('colaborador.pagos.principal'); // 👆 ajusta la vista
        $response->assertViewHas('pagos');
    }

    /** @test */
    public function store_crea_un_pago_y_redirige()
    {
        $user = User::factory()->create();

        $payload = [
            'monto' => 50000,
            'fecha' => now()->toDateString(),
            'metodo' => 'Efectivo',
            // 👉 agrega aquí los demás campos obligatorios de tu tabla pagos
        ];

        $response = $this->actingAs($user)->post(route('pagos.store'), $payload);

        $response->assertRedirect(route('pagos.dashboard'));
        $this->assertDatabaseHas('pagos', [
            'monto' => 50000,
            'metodo' => 'Efectivo',
        ]);
    }

    /** @test */
    public function store_valida_campos_requeridos()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('pagos.store'), []);

        $response->assertSessionHasErrors(['monto', 'fecha']); // 👈 ajusta a los campos requeridos reales
    }

    /** @test */
    public function destroy_elimina_un_pago()
    {
        $user = User::factory()->create();
        $pago = Pago::factory()->create();

        $response = $this->actingAs($user)->delete(route('pagos.destroy', $pago->id));

        $response->assertRedirect(route('pagos.dashboard'));
        $this->assertDatabaseMissing('pagos', ['id' => $pago->id]);
    }
}
