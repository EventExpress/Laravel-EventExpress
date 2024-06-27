<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use App\Models\Agendado;
use App\Models\Anuncio;
use App\Models\Usuario;
use Carbon\Carbon;

uses(TestCase::class, RefreshDatabase::class);

test('teste criar agendado', function () {
    $usuario = Usuario::factory()->create(['tipousu' => 'Cliente']);
    $anuncio = Anuncio::factory()->create(); 

    $response = $this->actingAs($usuario)
        ->post('/agendado', [
            'anuncio_id' => $anuncio->id,
            'data_inicio' => '2024-05-10',
            'data_fim' => '2024-05-12',
        ]);

    $response->assertRedirect('/agendado')
             ->assertSessionHas('success', 'Reserva criada com sucesso.');

    $this->assertDatabaseHas('agendados', [
        'anuncio_id' => $anuncio->id,
        'data_inicio' => '2024-05-10 00:00:00',
        'data_fim' => '2024-05-12 00:00:00',
    ]);
});

test('update agendado', function () {
    $usuario = Usuario::factory()->create(['tipousu' => 'Cliente']);
    $agendado = Agendado::factory()->create([
        'data_inicio' => '2024-05-15',
        'data_fim' => '2024-05-18',
        'usuario_id' => $usuario->id,
    ]);

    $response = $this->actingAs($usuario)
        ->put('/agendado/' . $agendado->id, [
            'data_inicio' => '2024-06-16',
            'data_fim' => '2024-07-17',
        ]);

    $response->assertRedirect('/agendado')
             ->assertSessionHas('success', 'Reserva atualizada com sucesso.');

    $this->assertDatabaseHas('agendados', [
        'id' => $agendado->id,
        'data_inicio' => '2024-06-16',
        'data_fim' => '2024-07-17',
    ]);
});

test('delete agendado', function () {
    $usuario = Usuario::factory()->create(['tipousu' => 'Cliente']);
    $agendado = Agendado::factory()->create([
        'data_inicio' => '2024-05-15',
        'data_fim' => '2024-05-18',
        'usuario_id' => $usuario->id,
    ]);

    $response = $this->actingAs($usuario)
        ->delete('/agendado/' . $agendado->id);

    $response->assertRedirect('/agendado')
             ->assertSessionHas('success', 'Reserva cancelada com sucesso.');

    $this->assertDatabaseMissing('agendados', [
        'id' => $agendado->id,
    ]);
});
