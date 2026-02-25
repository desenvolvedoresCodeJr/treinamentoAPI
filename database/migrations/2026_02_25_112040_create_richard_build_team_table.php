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
        Schema::create('richard_build_team', function (Blueprint $table) {
            $table->foreignId('build_id')->constrained('richard_builds')->cascadeOnDelete();
            $table->foreignId('character_id')->constrained('richard_characters')->cascadeOnDelete();
            $table->unsignedTinyInteger('position')->comment('1, 2 ou 3');

            $table->primary(['build_id', 'character_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('richard_build_team');
    }
};
