<?php

namespace Database\Factories;

use App\Models\Categoria;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoriaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'titulo' => fake()->randomElement(['Casamento','Festa Corporativa','Festa Infantil']),
            'descricao' => fake()->randomElement(['Realização de um evento', 'realização de uma festa']),
        ];
    }
}
