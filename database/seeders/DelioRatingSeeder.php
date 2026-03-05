<?php

namespace Database\Seeders;

use App\Models\DelioAlbum;
use App\Models\DelioRating;
use App\Models\DelioUser;
use Illuminate\Database\Seeder;

class DelioRatingSeeder extends Seeder
{
    public function run(): void
    {
        $usuarios = DelioUser::query()->pluck('id')->all();
        $albuns = DelioAlbum::query()->pluck('id')->all();

        if (empty($usuarios) || empty($albuns)) {
            return;
        }

        foreach ($usuarios as $usuarioId) {
            $albumIds = fake()->randomElements($albuns, fake()->numberBetween(3, 5));

            foreach ($albumIds as $albumId) {
                DelioRating::query()->updateOrCreate(
                    [
                        'usuario_id' => $usuarioId,
                        'album_id' => $albumId,
                    ],
                    [
                        'nota' => fake()->randomFloat(1, 3.5, 5.0),
                    ]
                );
            }
        }
    }
}
