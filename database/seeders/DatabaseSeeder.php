<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            IdentitySeeder::class,
            \Database\Seeders\Bruno\BrunoCartItemSeeder::class,
            \Database\Seeders\Bruno\BrunoProductSeeder::class,
            \Database\Seeders\Hadassa\HadassaCategorySeeder::class,
            \Database\Seeders\Hadassa\HadassaPostSeeder::class,
            \Database\Seeders\Luan\LuanGameSeeder::class,
            \Database\Seeders\Luan\LuanGenreSeeder::class,
            \Database\Seeders\Luan\LuanPlatformSeeder::class,
            \Database\Seeders\Luan\LuanReviewSeeder::class,
        ]);
    }
}
