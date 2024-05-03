<?php

use App\Models\Anuncio;
use App\Models\Endereco;
use App\Models\Usuario;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('cria um anúncio', function(){
    $usuario = Usuario::factory()->create();
    $endereco = Endereco::factory()->create();


    $response = $this->post('/anuncio', [
        'usuario_id' => $usuario->id,
        'titulo' => 'Título do Anúncio',
        'cidade' => $endereco->cidade,
        'cep' => $endereco->cep,
        'numero' => $endereco->numero,
        'bairro' => $endereco->bairro,
        'capacidade' => 100,
        'descricao' => 'Descrição do Anúncio',
        'valor' => 100.00,
        'agenda' => 'Agenda do Anúncio',
    ]);

    $response->assertRedirect('/anuncio');


    $this->assertDatabaseHas('anuncios', [
        'usuario_id' => $usuario->id,
        'titulo' => 'Título do Anúncio',
        'capacidade' => 100,
        'descricao' => 'Descrição do Anúncio',
        'valor' => 100.00,
        'agenda' => 'Agenda do Anúncio',
    ]);
});


test('deleta um anúncio', function () {
    $anuncio = Anuncio::factory()->create();

    $this->delete("/anuncio/{$anuncio->id}")
        ->assertRedirect('/anuncio');

    $this->assertDatabaseMissing('anuncios', [
        'id' => $anuncio->id,
    ]);
});

test('verifica se a busca está direcionando corretamente', function () {
    $searchTerm = 'Termo de Pesquisa';


    $response = $this->get("/anuncio?search={$searchTerm}");

    $response->assertStatus(200);
});
