<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\postJson;
use App\Models\Adicional;


uses(RefreshDatabase::class); 

test('acessa o formulário de criação de adicional', function () {
    $retorno = $this->get('adicional/create');
    $retorno->assertStatus(302);
});

test('verifica direcionamento da index/', function () {
    $response = $this->get('/adicional');
    $response->assertStatus(302);
});

test('verifica se o search está direcionando', function () {
    $adicional = Adicional::factory()->create();
    $response = $this->get("/adicional/{$adicional->id}");
    $response->assertStatus(302);
});

test('Rota delete redireciona corretamente após a exclusão', function () {
    $adicional = Adicional::factory()->create();

    $response = $this->withoutMiddleware()->delete("/adicional/{$adicional->id}");
    //$response = $this->delete("/adicional/{$adicional->id}", ['_token' => csrf_token()]);

    $response->assertStatus(302);

    $this->assertDatabaseMissing('adicionals', ['id' => $adicional->id]);
});

test ('create adicional', function (){
    
    $adicional = Adicional::factory()->create([
        'titulo' => 'Decoração',
        'descricao' => 'Adicional para festa',
        'valor' => '99.88',
    ]);
    $this->post(route('adicional.create'),$adicional->toArray());

    expect(Adicional::where('titulo', 'Decoração')->exists())->toBeTrue();
});

test ( 'update adicional ',function (){

    $adicional = Adicional::factory()->create([
        'titulo' => 'Decoração',
        'descricao' => 'Adicional para festa',
        'valor' => '99.88',
    ]);
    $adicional->update([
        'titulo' => 'Limpeza',
        'descricao' => 'Adicional para evento',
        'valor' => '88.99',
    ]);
    $adicional->refresh();

    expect($adicional->titulo)->toBe('Limpeza');
});

test ( 'delete adicional', function(){
        $adicional = Adicional::factory()->create();
        $adicional->delete();

        expect(adicional::find($adicional->id))->toBeNull();
});