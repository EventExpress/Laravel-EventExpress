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
        Schema::create('locadores', function (Blueprint $table) {
            $table->id();
            $table->string('nome',120);
            $table->string('email',120);
            $table->string('telefone',12);
            $table->string('cpf',11);
            $table->string('cnpj',14);
            $table->string('endereco',120);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locadores');
    }
};
