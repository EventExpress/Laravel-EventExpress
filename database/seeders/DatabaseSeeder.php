<?php

namespace Database\Seeders;

use App\Models\Adicional;
use App\Models\Agendado;
use App\Models\Nome;
use App\Models\User;
use App\Models\Anuncio;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Usuario;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        //User::factory()->create([
        //    'name' => 'Test User',
        //   'email' => 'test@example.com',
        //]);
        Anuncio::factory()->create();
        Usuario::factory()->create();
        //Categoria::factory()->create();
        Agendado::factory()->create();
        Adicional::factory()->create();
    }
}
