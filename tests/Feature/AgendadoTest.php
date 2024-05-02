<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\postJson;
use App\Models\Agendado;
use App\Models\Anuncio;

uses(RefreshDatabase::class); 

test('acessa o formulário de criação de agendado', function () {
    $retorno = $this->get('agendado/create');
    $retorno->assertStatus(200);
});

test('verifica direcionamento da index/', function () {
    $response = $this->get('/agendado');
    $response->assertStatus(200);
});

test('verifica se o search está direcionando', function () {
    $agendado = Agendado::factory()->create();
    $response = $this->get("/agendado/{$agendado->id}");
    $response->assertStatus(200);
});

test('Rota delete redireciona corretamente após a exclusão', function () {
    $agendado = Agendado::factory()->create();

    $response = $this->delete("/agendado/{$agendado->id}", ['_token' => csrf_token()]);

    $response->assertStatus(302);
    $this->assertDatabaseMissing('agendados', ['id' => $agendado->id]);
});

test ('create agendado', function (){
    $anuncio = Anuncio::factory()->create(); 
    
    $agendado = Agendado::factory()->create([
        'anuncio_id' => $anuncio->id,
        'data_inicio' => '2024-05-10',
        'data_fim' => '2024-05-12',
    ]);
    $this->post(route('agendado.create'),$agendado->toArray());

    expect(Agendado::where('data_inicio', '2024-05-10')->exists())->toBeTrue();
});

test ( 'update agendado ',function (){

    $agendado = Agendado::factory()->create([
        'data_inicio' => '2024-05-15',
        'data_fim' => '2024-05-18',
    ]);
    $agendado->update([
        'data_inicio' => '2024-06-16',
        'data_fim' => '2024-07-17',
    ]);
    $agendado->refresh();

    expect($agendado->data_inicio)->toBe('2024-06-16');
    expect($agendado->data_fim)->toBe('2024-07-17');
});

test ( 'delete agendado', function(){
        $agendado = Agendado::factory()->create();
        $agendado->delete();

        expect(agendado::find($agendado->id))->toBeNull();
});

