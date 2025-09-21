<?php

namespace Database\Factories;

use App\Models\Horario;
use App\Models\User;
use App\Models\Grupo;
use Illuminate\Database\Eloquent\Factories\Factory;

class HorarioFactory extends Factory
{
    protected $model = Horario::class;

    public function definition(): array
    {
        return [
            'instructor_id' => User::factory(),
            'grupo_id'      => Grupo::factory(),
            'dia'           => $this->faker->dayOfWeek,
            'fecha'         => $this->faker->date(),
            'hora_inicio'   => $this->faker->time('H:i'),
            'hora_fin'      => $this->faker->time('H:i'),
        ];
    }
}
