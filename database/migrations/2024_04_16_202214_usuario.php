<?php

use App\Models\Nome;
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
            $table->foreignId('nome_id')->constrained()->onDelete('cascade');
            $table->string('telefone',12);
            $table->string('email',120);
            $table->string('password');
            $table->rememberToken();
            $table->date('datanasc');
            $table->string('tipousu',50);
            $table->string('cpf',11);
            $table->string('cnpj',14)->nullable();
            $table->foreignId('endereco_id')->constrained()->onDelete('cascade');
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamps();
        });
        //obs: devido a classe nome ser um fk do id usuario achei (Guilherme) melhor unificar o cadastro dos 2 diferenciando atravez do tipo de usuario.

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
