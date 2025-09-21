<?php

namespace Database\Factories;

use App\Models\Grupo;
use Illuminate\Database\Eloquent\Factories\Factory;

class GrupoFactory extends Factory
{
    protected $model = Grupo::class;

    public function definition()
    {
        return [
            'nombre' => $this->faker->word,   // Ajusta al nombre de columna real en tu tabla grupos
        ];
    }
}
