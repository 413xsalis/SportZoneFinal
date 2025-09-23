<?php

namespace Database\Factories;

use App\Models\Grupo;
use Illuminate\Database\Eloquent\Factories\Factory;

class GrupoFactory extends Factory
{
    protected $model = Grupo::class;

    public function definition(): array
    {
        return [
            'nombre' => $this->faker->word(),
            // Agrega aquí otros campos requeridos por tu migración de grupos
        ];
    }
}
