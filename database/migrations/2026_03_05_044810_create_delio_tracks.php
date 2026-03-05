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
        Schema::create('delio_tracks', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('album_id')->constrained('delio_albums')->cascadeOnDelete();
            $table->string('titulo');
            $table->integer('duracao_em_segundos');
            $table->text('letra');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delio_tracks');
    }
};
