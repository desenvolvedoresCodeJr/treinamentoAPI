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
        Schema::create('luan_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId("usuario_id");
            $table->foreignId("jogo_id");
            $table->decimal("nota", 3, 1);
            $table->text("comentario")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('luan_reviews');
    }
};
