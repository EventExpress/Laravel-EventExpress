<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnuncioCategoriaTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('anuncio_categoria', function (Blueprint $table) {
            $table->usignedBigIntenger('anuncio_id');
            $table->usignedBigIntenger('categoria_id');
            $table->foreign('anuncio_id')->references('id')->on('anuncios')->onDelete('cascade');
            $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anuncio_categoria');
    }
};
