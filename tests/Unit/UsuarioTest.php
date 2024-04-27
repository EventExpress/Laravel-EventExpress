<?php

use App\Models\Endereco;
use App\Models\Nome;
use App\Models\Usuario;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class); // refresh cria o banco antes de cada teste / test inclue axuiliares de asserts etc...

test("Verifica se nome e endereco é um objeto", function () {
    $usuario = Usuario::factory()->create();

    $this->assertInstanceOf(Nome::class, $usuario->nome);

    $this->assertInstanceOf(Endereco::class, $usuario->endereco);
});

test("Teste criar Usuario", function () {
    $nome = Nome::factory()->create([
        'nome' => 'Teste Usuario',
    ]);

    $endereco = Endereco::factory()->create([
        'cidade' => 'Curitiba',
        'cep' => '81925-187',
        'numero' => '199',
        'bairro' => 'Sitio Cercado',
    ]);

    $usuario = Usuario::factory()->create([
        'nome_id' => $nome->id,
        'telefone' => '41988976119',
        'email' => 'testeusuario@gmail.com',
        'datanasc' => '13/02/2002',
        'tipousu' => 'Cliente',
        'cpf' => '132.321.432-12',
        'cnpj' => '',
        'endereco_id' => $endereco->id,
    ]);
    //o campo CNPJ está funcional quando colocar tipousu = "Locador"
    $this->assertDatabaseHas('usuarios', [
        'nome_id' => $nome->id,
        'telefone' => '41988976119',
        'email' => 'testeusuario@gmail.com',
        'datanasc' => '13/02/2002',
        'tipousu' => 'Cliente',
        'cpf' => '132.321.432-12',
        'cnpj' => '',
        'endereco_id' => $endereco->id,
    ]);
});

test("Teste delete Usuario",function (){
    $nome = Nome::factory()->create([
        'nome' => 'Teste Usuario',
    ]);

    $endereco = Endereco::factory()->create([
        'cidade' => 'Curitiba',
        'cep' => '81925-187',
        'numero' => '199',
        'bairro' => 'Sitio Cercado',
    ]);

    $usuario = Usuario::factory()->create([
        'nome_id' => $nome->id,
        'telefone' => '41988976119',
        'email' => 'testeusuario@gmail.com',
        'datanasc' => '13/02/2002',
        'tipousu' => 'Cliente',
        'cpf' => '132.321.432-12',
        'cnpj' => '',
        'endereco_id' => $endereco->id,
    ]);

    $this->assertDatabaseHas('usuarios', [
        'nome_id' => $nome->id,
        'telefone' => '41988976119',
        'email' => 'testeusuario@gmail.com',
        'datanasc' => '13/02/2002',
        'tipousu' => 'Cliente',
        'cpf' => '132.321.432-12',
        'cnpj' => '',
        'endereco_id' => $endereco->id,
    ]);

    $usuario ->delete();

    $this->assertDatabaseMissing('usuarios',['id'=>$usuario->id]);
});

test("Teste update Usuario",function (){

    $nome = Nome::factory()->create([
        'nome' => 'Teste Usuario',
    ]);

    $endereco = Endereco::factory()->create([
        'cidade' => 'Curitiba',
        'cep' => '81925-187',
        'numero' => '199',
        'bairro' => 'Sitio Cercado',
    ]);

    $usuario = Usuario::factory()->create([
        'nome_id' => $nome->id,
        'telefone' => '41988976119',
        'email' => 'testeusuario@gmail.com',
        'datanasc' => '13/02/2002',
        'tipousu' => 'Cliente',
        'cpf' => '132.321.432-12',
        'cnpj' => '',
        'endereco_id' => $endereco->id,
    ]);

    $novousuario = [
        'telefone' => '41988976120',
        'email' => 'novoemail@gmail.com',
    ];

    $novonome = [
        'nome' => 'Novo Nome',
    ];

    $novoendereco = [
        'cidade' => 'São Paulo',
        'cep' => '01000-000',
        'numero' => '123',
        'bairro' => 'Centro',
    ];

    $usuario->update($novousuario);
    $usuario->nome->update($novonome);
    $usuario->endereco->update($novoendereco);

    // verifica se foram atualizados corretamente
    $this->assertDatabaseHas('usuarios', [
        'id' => $usuario->id,
        'telefone' => '41988976120',
        'email' => 'novoemail@gmail.com',
        'datanasc' => '13/02/2002',
        'tipousu' => 'Cliente',
        'cpf' => '132.321.432-12',
        'cnpj' => '',
    ]);

    $this->assertDatabaseHas('nomes', [
        'id' => $nome->id,
        'nome' => 'Novo Nome',
    ]);

    $this->assertDatabaseHas('enderecos', [
        'id' => $endereco->id,
        'cidade' => 'São Paulo',
        'cep' => '01000-000',
        'numero' => '123',
        'bairro' => 'Centro',
    ]);

});

test('Verifica o relacionamento', function () {
    $nome = Nome::factory()->create();

    $usuario = Usuario::factory()->create([
        'nome_id' => $nome->id,
        'endereco_id' => Endereco::factory()->create()->id,
    ]);

    $this->assertEquals($nome->nome, $usuario->nome->nome);//verifica se o nome associado é igual ao usuario
});




