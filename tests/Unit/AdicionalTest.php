<?php

use App\Models\Adicional;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

test("Teste criar Adicional", function () {
    $adicional = Adicional::Factory()->create([
        'titulo' => 'Decoração',
        'descricao' => 'Adicional para festa',
        'valor' => '99.88',
    ]);

    $this->assertDatabaseHas(
        'adicionals',[
        'titulo' => 'Decoração',
        'descricao' => 'Adicional para festa',
        'valor' => '99.88',
    ]);
});

test("Teste atualizar Adicional", function () {
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

    $this->assertDatabaseHas('adicionals', [
        'titulo' => 'Limpeza',
        'descricao' => 'Adicional para evento',
        'valor' => '88.99',
    ]);
});

test("Teste deletar Adicional", function () {
    $adicional = Adicional::factory()->create([
        'titulo' => 'Decoração',
        'descricao' => 'Adicional para festa',
        'valor' => '99.88',
    ]);

    $adicional->delete();

    $this->assertDatabaseMissing('adicionals', [
        'titulo' => 'Decoração',
        'descricao' => 'Adicional para festa',
        'valor' => '99.88',
    ]);
});