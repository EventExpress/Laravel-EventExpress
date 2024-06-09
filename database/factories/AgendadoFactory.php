<?php

namespace Database\Factories;

use App\Models\Agendado;
use App\Models\Anuncio;
use Illuminate\Database\Eloquent\Factories\Factory;

class AgendadoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $anuncio = Anuncio::factory()->create();

        $dataInicio = $this->faker->dateTimeBetween('-1 month', '+1 month');
        $dataFim = $this->faker->dateTimeBetween($dataInicio, '+1 month');

        return [
            'anuncio_id' => $anuncio->id,
            'data_inicio' => $dataInicio,
            'data_fim' => $dataFim,
            'confirmado' => $this->faker->boolean(90),
        ];
    }
}
