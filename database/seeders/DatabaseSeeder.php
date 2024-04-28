<?php

namespace Database\Seeders;

use App\Models\Agendado;
use App\Models\Nome;
use App\Models\User;
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

        Usuario::factory()->create();
        //Categoria::factory()->createOne();
        //Agendado::factory()->createOne();
    }
}
