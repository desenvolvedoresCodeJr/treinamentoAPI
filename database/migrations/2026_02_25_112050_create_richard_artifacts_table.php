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
        Schema::create('richard_artifacts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('set_bonus_2');
            $table->text('set_bonus_4');
            $table->string('main_stats');
            $table->string('type');
            $table->string('icon');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('richard_artifacts');
    }
};
