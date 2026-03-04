<?php

namespace Database\Factories;

use App\Models\BalduttiProduct;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BalduttiProduct>
 */
class BalduttiProductFactory extends Factory
{
    protected $model = BalduttiProduct::class;

    public function definition(): array
    {
        return [
            'title' => fake()->words(3, true),
            'description' => fake()->paragraph(),
            'price' => fake()->randomFloat(2, 10, 5000),
            'type' => fake()->randomElement(['shape', 'rodas', 'skateMontado', 'truck', 'lixa', 'rolamento']),
            'image' => fake()->imageUrl(640, 480, 'fashion', true),
            'isFeatured' => fake()->boolean(),
        ];
    }
}
