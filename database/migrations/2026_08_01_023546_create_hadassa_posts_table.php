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
        Schema::create('hadassa_posts', function (Blueprint $table) {
            $table->id();
            $table->string("titulo");
            $table->text("descricao")->nullable();
            $table->foreignId("id_categoria");
            $table->string("imagem")->nullable();
            $table->foreignId("author_id");
            $table->dateTime("data")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hadassa_posts');
    }
};
