<?php

namespace Database\Seeders\Luan;

use Illuminate\Database\Seeder;
use App\Models\Luan\LuanPlatform;

class LuanPlatformSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $platforms = [
            'PC',
            'PlayStation',
            'Xbox',
            'Nintendo'
        ];

        foreach ($platforms as $platform) {
            LuanPlatform::firstOrCreate(['nome' => $platform]);
        }
    }
}
