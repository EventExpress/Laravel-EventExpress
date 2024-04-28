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
            $table->foreignId('nome_id')->constrained()->onDelete('cascade');
            $table->foreignId('anuncio_id')->constrained()->onDelete('cascade');
            $table->foreignId('adicional_id')->constrained()->onDelete('cascade');
            $table->string('status');
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
