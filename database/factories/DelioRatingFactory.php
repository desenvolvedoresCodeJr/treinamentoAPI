<?php

namespace Database\Factories;

use App\Models\DelioAlbum;
use App\Models\DelioRating;
use App\Models\DelioUser;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DelioRating>
 */
class DelioRatingFactory extends Factory
{
    protected $model = DelioRating::class;

    public function definition(): array
    {
        return [
            'usuario_id' => DelioUser::factory(),
            'album_id' => DelioAlbum::factory(),
            'nota' => fake()->randomFloat(1, 3.0, 5.0),
        ];
    }
}
