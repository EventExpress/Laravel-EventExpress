<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgendadoAdicionalTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('agendado_adicional', function (Blueprint $table) {
            $table->unsignedBigInteger('agendado_id');
            $table->unsignedBigInteger('adicional_id');
            $table->foreign('agendado_id')->references('id')->on('agendados')->onDelete('cascade');
            $table->foreign('adicional_id')->references('id')->on('adicionals')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agendado_adicional');
    }
};
