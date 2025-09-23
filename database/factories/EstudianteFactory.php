<?php

namespace Database\Factories;

use App\Models\Estudiante;
use Illuminate\Database\Eloquent\Factories\Factory;

class EstudianteFactory extends Factory
{
    protected $model = Estudiante::class;

    public function definition(): array
    {
        return [
            'documento' => $this->faker->unique()->numerify('#########'),
            'nombre_1' => $this->faker->firstName(),
            'nombre_2' => $this->faker->optional()->firstName(),
            'apellido_1' => $this->faker->lastName(),
            'apellido_2' => $this->faker->optional()->lastName(),
            'telefono' => $this->faker->phoneNumber(),
            'nombre_contacto' => $this->faker->name(),
            'telefono_contacto' => $this->faker->phoneNumber(),
            'eps' => $this->faker->word(),
            'grupo_id' => 1, // Ajusta según tus datos de prueba
            'id_subgrupo' => 1, // Ajusta según tus datos de prueba
            'estado' => true,
        ];
    }
}
