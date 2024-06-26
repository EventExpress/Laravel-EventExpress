<?php

namespace Database\Factories;

use App\Models\Endereco;
use App\Models\Nome;
use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Usuario>
 */
class UsuarioFactory extends Factory
{

    protected $model = Usuario::class;
    public function definition(): array
    {
        $endereco = Endereco::factory()->create();
        $nome = Nome::factory()->create();
        return [
            'nome_id' => $nome->id,
            'telefone' => $this->faker->numerify('(##)####-####'),
            'email' => $this->faker->email,
            'password' => $this->faker->numerify('xxx12345'),
            'datanasc' => $this->faker->dateTimeBetween('-80 years', '-18 years')->format('Y-m-d'),
            'tipousu' => $this->faker->randomElement(['Cliente', 'Locador']),
            'cpf' => $this->faker->numerify('###.###.###-##'),
            'cnpj' => $this->faker->numerify('##.###.###/####-##'),
            'endereco_id' => $endereco->id,
        ];
    }
}
