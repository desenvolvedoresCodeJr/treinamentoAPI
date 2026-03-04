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
        if (Schema::hasTable('bi_products') && ! Schema::hasTable('baldutti_products')) {
            Schema::rename('bi_products', 'baldutti_products');
            return;
        }

        if (! Schema::hasTable('baldutti_products')) {
            Schema::create('baldutti_products', function (Blueprint $table) {
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
        if (Schema::hasTable('baldutti_products') && ! Schema::hasTable('bi_products')) {
            Schema::rename('baldutti_products', 'bi_products');
        }
    }
};
