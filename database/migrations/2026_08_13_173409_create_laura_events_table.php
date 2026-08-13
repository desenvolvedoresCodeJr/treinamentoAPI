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
        Schema::create('laura_events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('title', 150);
            $table->text('description')->nullable();
            $table->string('banner_url', 255)->nullable();
            $table->string('location', 255)->nullable();
            $table->dateTime('event_date')->nullable();
            $table->decimal('price', 10, 2)->default(0.00);
            $table->string('official_network', 255)->nullable();
            $table->string('category', 50)->nullable();
            $table->string('type', 30)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laura_events');
    }
};
