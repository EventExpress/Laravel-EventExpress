<?php

use App\Models\Anuncio;
use App\Models\Categoria;
use App\Models\Endereco;
use App\Models\Usuario;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->usuario = Usuario::factory()->create(['tipousu' => 'Locador']);
    $this->actingAs($this->usuario);
    $this->endereco = Endereco::factory()->create(['cep' => '123456789']);
    $this->categoria = Categoria::factory()->count(3)->create();
});

test('cria um anúncio', function () {
    $response = $this->post('/anuncio', [
        'titulo' => 'Título do Anúncio',
        'cidade' => $this->endereco->cidade,
        'cep' => $this->endereco->cep,
        'numero' => $this->endereco->numero,
        'bairro' => $this->endereco->bairro,
        'capacidade' => 100,
        'descricao' => 'Descrição do Anúncio',
        'valor' => 100.00,
        'agenda' => now()->addDays(7)->toDateString(),
        'categoriaId' => $this->categoria->pluck('id')->toArray(),
    ]);

    // Verificar o status da resposta
    $response->assertStatus(302);

    // Exibir erros se houver
    if (session('errors')) {
        dd(session('errors')->all());
    }

    $response->assertRedirect('/anuncio');

    $this->assertDatabaseHas('anuncios', [
        'usuario_id' => $this->usuario->id,
        'titulo' => 'Título do Anúncio',
        'capacidade' => 100,
        'descricao' => 'Descrição do Anúncio',
        'valor' => 100.00,
        'agenda' => now()->addDays(7)->toDateString(),
        
    ]);
    $this->assertDatabaseHas('enderecos', [
        'cidade' => $this->endereco->cidade,
        'cep' => $this->endereco->cep,
        'numero' => $this->endereco->numero,
        'bairro' => $this->endereco->bairro,
    ]);
});

test('atualiza um anúncio', function () {
    $anuncio = Anuncio::factory()->create([
        'usuario_id' => $this->usuario->id,
        'endereco_id' => $this->endereco->id,
    ]);

    $response = $this->put("/anuncio/{$anuncio->id}", [
        'titulo' => 'Título Atualizado',
        'cidade' => 'Cidade Atualizada',
        'cep' => '12345678',
        'numero' => 999,
        'bairro' => 'Bairro Atualizado',
        'capacidade' => 200,
        'descricao' => 'Descrição Atualizada',
        'categoriaId' => $this->categoria->pluck('id')->toArray(),
    ]);

    $response->assertRedirect('/anuncio');

    $this->assertDatabaseHas('anuncios', [
        'id' => $anuncio->id,
        'titulo' => 'Título Atualizado',
        'capacidade' => 200,
        'descricao' => 'Descrição Atualizada',
    ]);

    $this->assertDatabaseHas('enderecos', [
        'id' => $this->endereco->id,
        'cidade' => 'Cidade Atualizada',
        'cep' => '12345678',
        'numero' => 999,
        'bairro' => 'Bairro Atualizado',
    ]);
});

test('deleta um anúncio', function () {
    $anuncio = Anuncio::factory()->create(['usuario_id' => $this->usuario->id]);

    $response = $this->delete("/anuncio/{$anuncio->id}");

    $response->assertRedirect('/anuncio');

    $this->assertDatabaseMissing('anuncios', [
        'id' => $anuncio->id,
    ]);
});

test('verifica se a busca está direcionando corretamente', function () {
    $searchTerm = 'Termo de Pesquisa';

    $response = $this->get("/anuncio?search={$searchTerm}");

    $response->assertStatus(200);
});