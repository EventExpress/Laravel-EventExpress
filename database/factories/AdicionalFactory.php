<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Adicional;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Adicional>
 */
class AdicionalFactory extends Factory
{
    protected $model = Adicional::class;
    public function definition(): array
    {

        return [
            'titulo' => fake()->randomElement(['Decoração', 'Limpeza']),
            'descricao'=> fake()->randomElement(['Adicional para festa', 'Adicional para evento']),
            'valor' => fake()->numerify('##.##'),
            'disponibilidade' => fake()->randomElement(['Está disponível', 'Não está disponível']),
        ];
    }
}