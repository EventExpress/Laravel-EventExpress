<?php

use App\Models\Usuario;
use App\Models\Nome;
use App\Models\Endereco;

test('profile page is displayed', function () {
    $user = Usuario::factory()->create();

    $response = $this
        ->actingAs($user)
        ->get('/profile');

    $response->assertOk();
});

test('profile information can be updated', function () {
    $user = Usuario::factory()->create();

    $response = $this
        ->actingAs($user)
        ->patch('/profile', [
            'nome' => 'Test User',
            'email' => 'test@example.com',
            'telefone' => '1234567890',
            'datanasc' => '1990-01-01',
            'tipousu' => 'tipo_teste',
            'cpf' => '12345678901',
            'cidade' => 'Test City',
            'cep' => '12345-678',
            'numero' => '123',
            'bairro' => 'Test Neighborhood',
        ]);

    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect('/profile');

    $user->refresh();

    $this->assertSame('Test User', $user->nome()->first()->nome);
    $this->assertSame('test@example.com', $user->email);
    $this->assertNull($user->email_verified_at);
    $this->assertSame('1234567890', $user->telefone);
    $this->assertSame('1990-01-01', $user->datanasc);
    $this->assertSame('tipo_teste', $user->tipousu);
    $this->assertSame('12345678901', $user->cpf);
    $this->assertSame('Test City', $user->endereco()->first()->cidade);
    $this->assertSame('12345-678', $user->endereco()->first()->cep);
    $this->assertSame('123', $user->endereco()->first()->numero);
    $this->assertSame('Test Neighborhood', $user->endereco()->first()->bairro);
});

test('email verification status is unchanged when the email address is unchanged', function () {
    $user = Usuario::factory()->create([
        'email_verified_at' => now(),
    ]);

    $response = $this
        ->actingAs($user)
        ->patch('/profile', [
            'nome' => 'Test User',
            'email' => $user->email,
            'telefone' => '1234567890',
            'datanasc' => '1990-01-01',
            'tipousu' => 'tipo_teste',
            'cpf' => '12345678901',
            'cidade' => 'Test City',
            'cep' => '12345-678',
            'numero' => '123',
            'bairro' => 'Test Neighborhood',
        ]);

    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect('/profile');

    $this->assertNotNull($user->refresh()->email_verified_at);
});

test('user can delete their account', function () {
    $user = Usuario::factory()->create([
        'password' => Hash::make('password')
    ]);
        

    $response = $this
        ->actingAs($user)
        ->delete('/profile', [
            'password' => 'password',
        ]);

    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect('/');

    $this->assertGuest();
    $this->assertNull($user->fresh());
});

test('correct password must be provided to delete account', function () {
    $user = Usuario::factory()->create();

    $response = $this
        ->actingAs($user)
        ->from('/profile')
        ->delete('/profile', [
            'password' => 'wrong-password',
        ]);

    $response
        ->assertSessionHasErrorsIn('userDeletion', 'password')
        ->assertRedirect('/profile');

    $this->assertNotNull($user->fresh());
});
