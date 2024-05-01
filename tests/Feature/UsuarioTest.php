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

test('verifica direcionamento da index/', function () {
    $response = $this->get('/usuario');
    $response->assertStatus(200);
});

test('verifica se o search está direcionando', function () {
    $usuario = Usuario::factory()->create();
    $response = $this->get("/usuario/{$usuario->id}");
    $response->assertStatus(200);
});

test('Rota delete redireciona corretamente após a exclusão', function () {
    $usuario = Usuario::factory()->create();

    $response = $this->delete("/usuario/{$usuario->id}", ['_token' => csrf_token()]);//token necessario para exclusão

    $response->assertStatus(302);
    $this->assertDatabaseMissing('usuarios', ['id' => $usuario->id]);
});

test('cria um novo usuário', function () {
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

test('atualiza Usuario', function () {

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
    $usuario->update([
        'telefone' => '41988070119',
        'cpf' => '143.222.555-02',
    ]);
    $usuario->refresh();

    expect($usuario->telefone)->toBe('41988070119');
    expect($usuario->cpf)->toBe('143.222.555-02');
});

test('deletar usuario', function () {

    $usuario = Usuario::factory()->create();
    $usuario->delete();

    expect(usuario::find($usuario->id))->toBeNull();
});

test(' verifica se é possivel atualizar tabela nome', function () {

    $nome = Nome::factory()->create();
    $usuario = Usuario::factory()->create();

    $usuario->update(['nome_id' => $nome->id]);//verifica a associação atualizando o nome_id pelo id do nome.
    $usuario->refresh();

    expect($usuario->nome_id)->toBe($nome->id);
});

