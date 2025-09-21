<?php

namespace Database\Factories;

use App\Models\Estudiante;
use App\Models\Grupo;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;


class EstudianteFactory extends Factory
{
    use RefreshDatabase;
    protected $model = Estudiante::class;

    public function definition()
    {
        return [
            'documento' => $this->faker->unique()->numerify('#########'),
            'nombre_1' => $this->faker->firstName,
            'nombre_2' => $this->faker->firstName,
            'apellido_1' => $this->faker->lastName,
            'apellido_2' => $this->faker->lastName,
            'telefono' => $this->faker->phoneNumber,
            'nombre_contacto' => $this->faker->name,
            'telefono_contacto' => $this->faker->phoneNumber,
            'eps' => $this->faker->company,
            'grupo_id' => Grupo::factory(),
            'id_subgrupo' => null,
            'estado' => 1,
        ];
    }
}
