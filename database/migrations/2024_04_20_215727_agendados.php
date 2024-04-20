<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('agendados', function (Blueprint $table){
            $table->id();
            $table->string('nome', 80);
            $table->string('reservas', 50);
            $table->string('contrato', 20);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agendados');
    }
};
