<?php
use App\Models\Endereco;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

test("Teste criar Endereco", function () {
    $endereco = Endereco::Factory()->create([
        'cidade'=>'Curitiba',
        'cep'=>'81925-187',
        'numero'=>'199',
        'bairro'=>'Sitio Cercado',
    ]);

    $this->assertDatabaseHas(
        'enderecos',[
        'cidade'=>'Curitiba',
        'cep'=>'81925-187',
        'numero'=>'199',
        'bairro'=>'Sitio Cercado',
    ]);
});

test("Teste atualizar Endereco", function () {
    $endereco = Endereco::factory()->create([
        'cidade' => 'Curitiba',
        'cep' => '81925-187',
        'numero' => '199',
        'bairro' => 'Sitio Cercado',
    ]);

    $endereco->update([
        'cidade' => 'São Paulo',
        'cep' => '81923-981',
        'numero' => '2101',
        'bairro' => 'CIC',
    ]);

    $this->assertDatabaseHas('enderecos', [
        'cidade' => 'São Paulo',
        'cep' => '81923-981',
        'numero' => '2101',
        'bairro' => 'CIC',
    ]);
});

test("Teste deletar Endereco", function () {
    $endereco = Endereco::factory()->create([
        'cidade' => 'Curitiba',
        'cep' => '81925-187',
        'numero' => '199',
        'bairro' => 'Sitio Cercado',
    ]);

    $endereco->delete();

    $this->assertDatabaseMissing('enderecos', [
        'cidade' => 'Curitiba',
        'cep' => '81925-187',
        'numero' => '199',
        'bairro' => 'Sitio Cercado',
    ]);
});
