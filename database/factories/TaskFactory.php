<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->realText(50),
            'body'  => fake()->realText(200),
            'author_id' => fake()->numberBetween(1, 3),
            'date' => Carbon::now(),
            'status' => fake()->randomElement(['pending', 'completed'])
        ];
    }
}
