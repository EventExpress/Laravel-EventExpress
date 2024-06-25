<?php

use App\Models\Endereco;
use App\Models\Nome;

test('registration screen can be rendered', function () {
    $response = $this->get('/register');

    $response->assertStatus(200);
});

