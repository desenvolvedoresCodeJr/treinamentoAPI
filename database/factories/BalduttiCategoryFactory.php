<?php

namespace Database\Factories;

use App\Models\BalduttiCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BalduttiCategory>
 */
class BalduttiCategoryFactory extends Factory
{
    protected $model = BalduttiCategory::class;

    public function definition(): array
    {
        return [
            'title' => fake()->words(3, true),
            'description' => fake()->paragraph(),
            'price' => fake()->randomFloat(2, 10, 5000),
            'type' => fake()->randomElement(['SOCIAL', 'ESPORTIVO', 'SMARTWATCH']),
            'image' => fake()->imageUrl(640, 480, 'fashion', true),
            'isFeatured' => fake()->boolean(),
        ];
    }
}
