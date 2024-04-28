<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Adicional;
use App\Models\Categoria;
use App\Models\Anuncio;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Adicional>
 */
class AdicionalFactory extends Factory
{
    protected $model = Adicional::class;
    public function definition(): array
    {
        $anuncio = Anuncio::factory()->create();
        $categoria = Categoria::factory()->create();

        return [
            'titulo' => fake()->randomElement(['Decoração', 'Limpeza']),
            'anuncio_id' => $anuncio->id,
            'categoria_id' => $categoria->id,
            'descricao'=> fake()->randomElement(['Adicional para festa', 'Adicional para evento']),
            'valor' => fake()->numerify('##.##'),
            'disponibilidade' => fake()->randomElement(['Está disponível', 'Não está disponível']),
            //'status' => $status->
        ];
    }
}