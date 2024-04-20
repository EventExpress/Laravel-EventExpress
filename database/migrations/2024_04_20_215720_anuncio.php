<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('anuncio', function (Blueprint $table){
            $table->id();
            $table->string('nome', 80);
            $table->string('categoria', 30);
            $table->string('endereco', 120);
            $table->string('capacidade', 50);
            $table->string('descricao', 100);
            $table->string('locador', 80);
            $table->decimal('valor', 10);
            $table->date('agenda');
            $table->string('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anuncio');
    }
};
