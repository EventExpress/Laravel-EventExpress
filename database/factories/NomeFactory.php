<?php

namespace Database\Factories;

use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Nome;

class NomeFactory extends Factory{

    protected $model = Nome::class;

    public function definition(): array
    {
        $usuario = Usuario::factory()->create();

        return [
            'usuario_id' => $usuario->id,
            'nome' => $usuario->nome,
        ];
    }
}
