<?php

namespace Database\Seeders\Hadassa;

use Illuminate\Database\Seeder;
use App\Models\Hadassa\HadassaCategory;

class HadassaCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Estrelas',
            'Planetas',
            'Galáxias',
            'Nebulosas',
            'Constelações'
        ];

        foreach ($categories as $category) {
            HadassaCategory::firstOrCreate(['categoria' => $category]);
        }
    }
}
