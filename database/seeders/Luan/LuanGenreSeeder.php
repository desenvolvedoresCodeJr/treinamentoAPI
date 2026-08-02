<?php

namespace Database\Seeders\Luan;

use Illuminate\Database\Seeder;
use App\Models\Luan\LuanGenre;

class LuanGenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $genres = [
            'Ação',
            'Aventura',
            'Ação e Aventura',
            'RPG',
            'Estratégia',
            'Simulação',
            'Esporte',
            'Corrida',
            'Luta',
            'FPS',
            'TPS',
            'Plataforma',
            'Puzzle',
            'Terror',
            'Sobrevivência'
        ];

        foreach ($genres as $genre) {
            LuanGenre::firstOrCreate(['genero' => $genre]);
        }
    }
}
