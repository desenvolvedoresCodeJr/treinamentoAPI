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
        if (Schema::hasTable('bi_categories') && ! Schema::hasTable('baldutti_categories')) {
            Schema::rename('bi_categories', 'baldutti_categories');
            return;
        }

        if (! Schema::hasTable('baldutti_categories')) {
            Schema::create('baldutti_categories', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->text('description');
                $table->decimal('price', 8, 2);
                $table->string('type');
                $table->string('image');
                $table->boolean('isFeatured');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('baldutti_categories') && ! Schema::hasTable('bi_categories')) {
            Schema::rename('baldutti_categories', 'bi_categories');
        }
    }
};
