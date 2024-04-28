<?php

use App\Models\Categoria;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

test("Teste criar Categoria", function () {
    $categoria = Categoria::Factory()->create([
        'titulo'=>'Festa Infantil',
        'descricao'=>'Festa para crianças',
    ]);

    $this->assertDatabaseHas(
        'categorias',[
        'titulo'=>'Festa Infantil',
        'descricao'=>'Festa para crianças',
    ]);
});

test("Teste atualizar Categoria", function () {
    $categoria = Categoria::factory()->create([
        'titulo'=>'Festa Infantil',
        'descricao'=>'Festa para crianças',
    ]);

    $categoria->update([
        'titulo'=>'Festa de aniversario',
        'descricao'=>'Confraternização para comemorar aniversario',
    ]);

    $this->assertDatabaseHas('categorias', [
        'titulo'=>'Festa de aniversario',
        'descricao'=>'Confraternização para comemorar aniversario',
    ]);
});

test("Teste deletar Categoria", function () {
    $categoria = Categoria::factory()->create([
        'titulo'=>'Festa Infantil',
        'descricao'=>'Festa para crianças',
    ]);

    $categoria->delete();

    $this->assertDatabaseMissing('categorias', [
        'titulo'=>'Festa Infantil',
        'descricao'=>'Festa para crianças',
    ]);
});