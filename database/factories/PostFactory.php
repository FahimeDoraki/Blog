<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Category;

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
    public function definition()
    {
        
        return [
            'title' => fake()->title(),
            'content' => fake()->paragraph(),
            'image' => fake()->imageUrl($width=500, $height=400),
            'slug' => fake()->slug(),
            'active' => fake()->randomElement([0, 1]),
            'keywords' => fake()->word(),
            'user_id' => User::all()->random()->id,
            'category_id' => Category::all()->random()->id
        ];
    }
}
