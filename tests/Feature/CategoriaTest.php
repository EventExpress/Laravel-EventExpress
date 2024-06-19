<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\postJson;
use App\Models\Categoria;

uses(RefreshDatabase::class); 

test('acessa o formulário de criação de categoria', function () {
    $retorno = $this->get('categoria/create');
    $retorno->assertStatus(200);
});

test('verifica direcionamento da index/', function () {
    $response = $this->get('/categoria');
    $response->assertStatus(200);
});

test('verifica se o search está direcionando', function () {
    $categoria = Categoria::factory()->create();
    $response = $this->get("/categoria/{$categoria->id}");
    $response->assertStatus(200);
});

test('Rota delete redireciona corretamente após a exclusão', function () {
    $categoria = Categoria::factory()->create();

    $response = $this->delete("/categoria/{$categoria->id}", ['_token' => csrf_token()]);

    $response->assertStatus(302);
    $this->assertDatabaseMissing('categorias', ['id' => $categoria->id]);
});

test ('create categoria', function (){ 
    
    $categoria = Categoria::factory()->create([
        'titulo'=>'Festa Infantil',
        'descricao'=>'Festa para crianças',
    ]);
    $this->post(route('categoria.create'),$categoria->toArray());

    expect(Categoria::where( 'titulo', 'Festa Infantil',)->exists())->toBeTrue();
});

test ( 'update categoria ',function (){

    $categoria = Categoria::factory()->create([
        'titulo'=>'Festa Infantil',
        'descricao'=>'Festa para crianças',
    ]);
    $categoria->update([
        'titulo'=>'Festa de aniversario',
        'descricao'=>'Confraternização para comemorar aniversario',
    ]);
    $categoria->refresh();
    expect($categoria->titulo)->toBe('Festa de aniversario');
    expect($categoria->descricao)->toBe('Confraternização para comemorar aniversario');
});

test ( 'delete categoria', function(){
        $categoria = Categoria::factory()->create();
        $categoria->delete();

        expect(categoria::find($categoria->id))->toBeNull();
});

