<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\postJson;
use App\Models\Agendado;
use App\Models\Anuncio;
use App\Models\Usuario;

uses(RefreshDatabase::class);

beforeEach(function () {
    $usuario = Usuario::factory()->create(['tipousu' => 'Cliente']);
    $this->actingAs($usuario);
});

test('acessa o formulário de criação de agendado', function () {
    $anuncio = Anuncio::factory()->create();
    $anuncioId = $anuncio->id;

    $retorno = $this->get("anuncio/{$anuncioId}/reservar");

    $retorno->assertStatus(200);
});


test('verifica direcionamento da index/', function () {
    $response = $this->get('/agendado');
    $response->assertStatus(200);
});

test('verifica se o search está direcionando', function () {
    $agendado = Agendado::factory()->create(['usuario_id' => Auth::id()]);
    $response = $this->get("/agendado/{$agendado->id}");
    $response->assertStatus(200);
});

test('Rota delete redireciona corretamente após a exclusão', function () {
    $agendado = Agendado::factory()->create(['usuario_id' => Auth::id()]);

    $response = $this->delete("/agendado/{$agendado->id}", ['_token' => csrf_token()]);

    $response->assertStatus(302);
    $this->assertDatabaseMissing('agendados', ['id' => $agendado->id]);
});


test('create agendado', function () {
    $anuncio = Anuncio::factory()->create();

    $agendadoData = [
        'anuncio_id' => $anuncio->id,
        'data_inicio' => '2024-05-10',
        'data_fim' => '2024-05-12',
        'usuario_id' => Auth::id(),
    ];

    $response = $this->post(route('agendado.store'), $agendadoData);

    $response->assertRedirect('/agendado');
    $this->assertDatabaseHas('agendados', [
        'anuncio_id' => $anuncio->id,
        'data_inicio' => '2024-05-10 00:00:00',
        'data_fim' => '2024-05-12 00:00:00',
        'usuario_id' => Auth::id(),
    ]);
});


test ( 'update agendado ',function (){

    $agendado = Agendado::factory()->create([
        'data_inicio' => '2024-05-15',
        'data_fim' => '2024-05-18',
        'usuario_id' => Auth::id(),
    ]);

    $updateData = [
        'data_inicio' => '2024-06-16',
        'data_fim' => '2024-07-17',
        'usuario_id' => Auth::id(),
    ];

    $response = $this->put(route('agendado.update', $agendado->id), $updateData);

    $response->assertRedirect('/agendado');
    $agendado->refresh();

    expect($agendado->data_inicio)->toBe('2024-06-16');
    expect($agendado->data_fim)->toBe('2024-07-17');
});

test ( 'delete agendado', function(){
        $agendado = Agendado::factory()->create(['usuario_id' => Auth::id()]);
        $agendado->delete();

        expect(agendado::find($agendado->id))->toBeNull();
});

