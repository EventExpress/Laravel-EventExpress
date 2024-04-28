<?php

namespace Database\Factories;

use App\Models\Nome;
use App\Models\Adicional;
use App\Models\Agendado;
use App\Models\Anuncio;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class AgendadoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $anuncio = Anuncio::factory()->create();
        $adicional = Adicional::factory()->create();
        $nome = Nome::factory()->create();
        return [
            'nome_id' => $nome->id,
            'anuncio_id' => $anuncio->id,
            'adicional_id' => $adicional->id,
            //'status' => $status
            
        ];
    }
}