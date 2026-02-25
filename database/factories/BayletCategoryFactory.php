<?php

namespace Database\Factories;

use App\Models\BayletCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BayletCategory>
 */
class BayletCategoryFactory extends Factory
{
    protected $model = BayletCategory::class;

    public function definition(): array
    {
        return [
            'name' => fake()->randomElement(['SOCIAL', 'ESPORTIVO', 'SMARTWATCH']),
        ];
    }
}
