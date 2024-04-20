<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Usuario>
 */
class UsuarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome' =>fake()->name,
            'telefone'=>fake()->numerify('(##)####-####'),
            'email' =>fake()->email,
            'datanasc'=>fake()->dateTimeBetween('-80 years', '-18 years')->format('Y-m-d'),
            'cpf'=>fake()->numerify('###.###.###-##')
        ];
    }
}
