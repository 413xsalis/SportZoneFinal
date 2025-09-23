<?php

namespace Database\Factories;

use App\Models\Subgrupo;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubgrupoFactory extends Factory
{
    protected $model = Subgrupo::class;

    public function definition(): array
    {
        return [
            'nombre' => $this->faker->word(),
            'grupo_id' => null, // Se debe asignar explícitamente en el test
        ];
    }
}
