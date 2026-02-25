<?php

namespace Database\Factories;

use App\Models\BayletCategory;
use App\Models\BayletPublication;
use App\Models\BayletUser;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BayletPublication>
 */
class BayletPublicationFactory extends Factory
{
    protected $model = BayletPublication::class;

    public function definition(): array
    {
        return [
            'name' => fake()->sentence(3),
            'description' => fake()->paragraph(),
            'price' => fake()->randomFloat(2, 100, 5000),
            'category_id' => BayletCategory::factory(),
            'created_by' => BayletUser::factory(),
            'status' => fake()->randomElement(['ACTIVE', 'INACTIVE']),
        ];
    }
}
