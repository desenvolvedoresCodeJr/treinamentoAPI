<?php

namespace Database\Factories;

use App\Models\BayletUser;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BayletUser>
 */
class BayletUserFactory extends Factory
{
    protected $model = BayletUser::class;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'password' => Hash::make('password'),
            'role' => fake()->randomElement(['CLIENT', 'ADMIN']),
        ];
    }
}
