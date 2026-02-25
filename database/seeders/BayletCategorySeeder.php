<?php

namespace Database\Seeders;

use App\Models\BayletCategory;
use Illuminate\Database\Seeder;

class BayletCategorySeeder extends Seeder
{
    public function run(): void
    {
        foreach (['SOCIAL', 'ESPORTIVO', 'SMARTWATCH'] as $name) {
            BayletCategory::firstOrCreate(['name' => $name]);
        }
    }
}
