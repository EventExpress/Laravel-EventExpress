<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('nome',120);
            $table->string('telefone',12);
            $table->string('email',120);
            $table->date('datanasc');
            $table->string('tipousu',50);
            $table->string('cpf',11);
            $table->string('cnpj',14)->nullable();
            $table->string('endereco',120);
            $table->timestamps();
        });
        //obs: devido a classe nome ser um fk do id usuario achei (Guilherme) melhor unificar o cadastro dos 2 diferenciando atravez do tipo de usuario.
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
