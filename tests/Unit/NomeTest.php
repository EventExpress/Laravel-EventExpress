<?php

use App\Models\Nome;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

test("Testar criar Nome",function (){
    $nome = Nome::factory()->create([
        'nome'=>'Teste Usuario',
    ]);

    $this->assertDatabaseHas(
        'nomes',[
            'nome'=>'Teste Usuario',
        ]
    );
});

test('Teste update Nome', function () {
    $nome = Nome::factory()->create([
        'nome' => 'Teste Reinaldo',
    ]);
    $nome ->update([
       'nome' => 'Reinaldo Teste Alemir',
    ]);

    $this->assertDatabaseHas('nomes',[
        'nome' => 'Reinaldo Teste Alemir',
        ]);
});

test('Teste delete Nome', function () {
    $nome = Nome::factory()->create([
        'nome' => 'Teste Usuario',
    ]);
    $nome ->delete();

    $this->assertDatabaseMissing('nomes', ['nome' => 'Teste Usuario']);
});
