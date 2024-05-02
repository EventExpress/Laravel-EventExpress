<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Agendado;
use App\Models\Anuncio;

uses(TestCase::class, RefreshDatabase::class);

    
test('teste criar agendado', function(){
    $anuncio = Anuncio::factory()->create(); // Criar um anúncio fictício para o teste

        $agendado = Agendado::Factory()->create([
            'anuncio_id' => $anuncio->id,
            'data_inicio' => '2024-05-10',
            'data_fim' => '2024-05-12',
        ]);

        $this->assertDatabaseHas('agendados', [
            'anuncio_id' => $anuncio->id,
            'data_inicio' => '2024-05-10',
            'data_fim' => '2024-05-12',
        ]);    
});

test('update agendado ',function (){
    $agendado = Agendado::factory()->create([
        'data_inicio' => '2024-05-15',
        'data_fim' => '2024-05-18',
    ]);

    $agendado->update([
        'data_inicio' => '2024-06-16',
        'data_fim' => '2024-07-17',
    ]);

    $this->assertDatabaseHas('agendados', [
        'data_inicio' => '2024-06-16',
        'data_fim' => '2024-07-17',
    ]);
});

test('delete agendado', function (){
    $agendado = Agendado::factory()->create([
        'data_inicio' => '2024-05-15',
        'data_fim' => '2024-05-18',
    ]);
    $agendado->delete();

    $this->assertDatabaseMissing('agendados', [
        'data_inicio' => '2024-05-15',
        'data_fim' => '2024-05-18',
    ]);
    
});