<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'post_id' => rand(1, 1000), // Assuming you have 1000 posts
            'name' => $this->faker->boolean() ? $this->faker->name : null,
            'email' => $this->faker->boolean() ? $this->faker->unique()->safeEmail : null,
            'description' => $this->faker->paragraph,
        ];
    }
}
