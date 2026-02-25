<?php

namespace Database\Seeders;

use App\Models\BayletUser;
use Illuminate\Database\Seeder;

class BayletUserSeeder extends Seeder
{
    public function run(): void
    {
        BayletUser::factory()->count(10)->create();
    }
}
