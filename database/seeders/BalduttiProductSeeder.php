<?php

namespace Database\Seeders;

use App\Models\BalduttiProduct;
use Illuminate\Database\Seeder;

class BalduttiProductSeeder extends Seeder
{
    public function run(): void
    {
        BalduttiProduct::factory()->count(20)->create();
    }
}
