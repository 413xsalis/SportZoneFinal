<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class PerfilControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function muestra_la_pagina_de_perfil_del_usuario_autenticado()
    {
        $user = User::factory()->create();

        // Simula que el usuario está logueado
        $response = $this->actingAs($user)->get(route('perfil.index'));
        // 👆 Ajusta el nombre de la ruta que tengas en `web.php`

        $response->assertStatus(200);
        $response->assertViewIs('perfil.index'); // 👈 cámbialo al nombre real de tu vista
        $response->assertSee($user->name);
    }

    /** @test */
    public function actualiza_los_datos_del_perfil()
    {
        $user = User::factory()->create();

        $payload = [
            'name' => 'Nuevo Nombre',
            'email' => 'nuevo@example.com',
        ];

        $response = $this->actingAs($user)->put(route('perfil.update'), $payload);
        // 👆 Ajusta al nombre de tu ruta para actualizar perfil

        $response->assertRedirect(route('perfil.index'));
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'Nuevo Nombre',
            'email' => 'nuevo@example.com',
        ]);
    }
}
