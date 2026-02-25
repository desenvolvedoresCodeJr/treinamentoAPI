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
        Schema::create('richard_characters', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('element');
            $table->string('region');
            $table->string('weapon_type');
            $table->boolean('rarity');
            $table->string('icon');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('richard_characters');
    }
};
