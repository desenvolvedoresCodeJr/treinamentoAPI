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
        Schema::create('richard_build_weapons', function (Blueprint $table) {
            $table->foreignId('build_id')->constrained('richard_builds')->cascadeOnDelete();
            $table->foreignId('weapon_id')->constrained('richard_weapons')->cascadeOnDelete();
            $table->unsignedTinyInteger('position')->comment('1 a 4');

            $table->primary(['build_id', 'weapon_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('richard_build_weapons');
    }
};
