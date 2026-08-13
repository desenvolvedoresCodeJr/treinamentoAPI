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
        Schema::create('sophia_posts', function (Blueprint $table) {
            $table->id();
            $table->string('titulo', 150);
            $table->text('descricao')->nullable();
            $table->string('caminho_foto', 255)->nullable();
            $table->string('uid', 20)->nullable();
            $table->foreignId('usuario_id');
            $table->foreignId('personagem_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sophia_posts');
    }
};
