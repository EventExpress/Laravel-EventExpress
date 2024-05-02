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
            $table->foreignId('anuncio_id')->constrained()->onDelete('cascade');
            $table->dateTime('data_inicio');
            $table->dateTime('data_fim');
            $table->boolean('confirmado')->default(false);
            $table->timestamps();
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
