<?php

use App\Models\Endereco;
use App\Models\Nome;
use App\Models\Usuario;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\postJson;

uses(RefreshDatabase::class);


test('acessa o formulário de criação de usuário', function () {
    $retorno = $this->get('usuario/create');
    $retorno->assertStatus(200);
});

test('cria um novo usuário', function () {
    $response = $this->get('usuario/create');
    $response->assertStatus(200);

    $endereco = Endereco::factory()->create();

    $nome = Nome::factory()->create();

    $usuario = Usuario::factory()->create([
        'nome_id' => $nome->id,
        'telefone' => '123456789',
        'email' => 'usuario@teste.com',
        'datanasc' => '1990-01-09',
        'tipousu' => 'Cliente',
        'cpf' => '123.456.789-01',
        'cnpj' => '',
        'endereco_id' => $endereco->id,
    ]);

    // requisição POST para criar o usuário e retorna um array pq eu passei acima
    $this->post(route('usuario.create'), $usuario->toArray());

    // busca no banco e ve se foi criado
    expect(Usuario::where('telefone', '123456789')->exists())->toBeTrue();
});

test('verifica se após a criação de um usuário é direcionado para a página inicial', function () {
    $response = $this->get('usuario');
    $response->assertStatus(200);

    $endereco = Endereco::factory()->create();

    $nome = Nome::factory()->create();

    $usuario = Usuario::factory()->create([
        'nome_id' => $nome->id,
        'telefone' => '123456789',
        'email' => 'usuario@teste.com',
        'datanasc' => '1990-01-09',
        'tipousu' => 'Cliente',
        'cpf' => '123.456.789-01',
        'cnpj' => '',
        'endereco_id' => $endereco->id,
    ]);

    $response = $this->post(route('usuario.create'), $usuario->toArray());

    $response->assertRedirect('/usuario');

    expect(Usuario::where('telefone', '123456789')->exists())->toBeTrue();
});

