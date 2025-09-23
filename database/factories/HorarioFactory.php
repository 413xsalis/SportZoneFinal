<?php

namespace Database\Factories;

use App\Models\Horario;
use Illuminate\Database\Eloquent\Factories\Factory;

class HorarioFactory extends Factory
{
    protected $model = Horario::class;

    public function definition(): array
    {
        return [
            'fecha' => $this->faker->date(),
            'hora_inicio' => $this->faker->time('H:i'),
            'hora_fin' => $this->faker->time('H:i'),
            'dia' => $this->faker->dayOfWeek(),
            // Agrega aquí otros campos requeridos por tu migración de horarios
            'grupo_id' => 1, // Ajusta según tus datos de prueba
            'instructor_id' => 1, // Ajusta según tus datos de prueba
        ];
    }
}
