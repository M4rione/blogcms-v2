<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->unique()->sentence(6);
        return [
            'title' => $title,
            'slug' => str()->slug($title) . '-' . fake()->unique()->numberBetween(1000,9999),
            'content' => fake()->paragraphs(6, true),
            'image' => null,
            'views' => fake()->numberBetween(0, 5000),
            'user_id' => User::factory(),
            'category_id' => Category::factory(),
        ];
    }
}