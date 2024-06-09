<?php

namespace Tests\Unit\Controllers;

use Tests\TestCase;
use App\Models\Anuncio;
use App\Models\Endereco;
use App\Models\Usuario;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(TestCase::class, RefreshDatabase::class);

test("Testa criar Anúncio", function () {
    $endereco = Endereco::factory()->create([
        'cidade' => 'Curitiba',
        'cep' => '81925-187',
        'numero' => '199',
        'bairro' => 'Sitio Cercado',
    ]);

    $usuario = Usuario::factory()->create();

    $anuncio = Anuncio::factory()->create([
        'usuario_id' => $usuario->id,
        'endereco_id' => $endereco->id,
        'titulo' => 'Título do Anúncio',
        'capacidade' => 5,
        'descricao' => 'Descrição do Anúncio',
        'valor' => 100.00,
        'agenda' => 'Agenda do Anúncio',
    ]);

    $this->assertDatabaseHas('anuncios', [
        'usuario_id' => $usuario->id,
        'endereco_id' => $endereco->id,
        'titulo' => 'Título do Anúncio',
        'capacidade' => 5,
        'descricao' => 'Descrição do Anúncio',
        'valor' => 100.00,
        'agenda' => 'Agenda do Anúncio',
    ]);
});

test("Testa deletar Anúncio", function () {
    $anuncio = Anuncio::factory()->create();

    $this->assertDatabaseHas('anuncios', [
        'id' => $anuncio->id,
    ]);

    $anuncio->delete();

    $this->assertDatabaseMissing('anuncios', [
        'id' => $anuncio->id,
    ]);
});

test("Testa atualizar Anúncio", function () {
    $anuncio = Anuncio::factory()->create([
        'titulo' => 'Título Antigo',
    ]);

    $novosDados = [
        'titulo' => 'Novo Título',
    ];

    $anuncio->update($novosDados);

    $this->assertDatabaseHas('anuncios', [
        'id' => $anuncio->id,
        'titulo' => 'Novo Título',

    ]);
});
