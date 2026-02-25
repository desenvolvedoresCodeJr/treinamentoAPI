<?php

namespace Database\Seeders;

use App\Models\BalduttiCategory;
use Illuminate\Database\Seeder;

class BalduttiCategorySeeder extends Seeder
{
    public function run(): void
    {
        BalduttiCategory::factory()->count(20)->create();
    }
}
