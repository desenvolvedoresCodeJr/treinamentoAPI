<?php

namespace Database\Factories;

use App\Models\DelioAlbum;
use App\Models\DelioTrack;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DelioTrack>
 */
class DelioTrackFactory extends Factory
{
    protected $model = DelioTrack::class;

    public function definition(): array
    {
        return [
            'album_id' => DelioAlbum::factory(),
            'titulo' => fake()->randomElement([
                'Billie Jean',
                'Beat It',
                'Hells Bells',
                'Money',
                'Come Together',
                'Dreams',
                'Smells Like Teen Spirit',
                'Someone Like You',
            ]),
            'duracao_em_segundos' => fake()->numberBetween(150, 430),
            'letra' => fake()->sentence(14),
        ];
    }
}
