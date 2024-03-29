<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use App\Models\User;
use App\Models\Category;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->text(35),
            'description' => fake()->text(200),
            'price' => fake()->randomFloat(2, 0, 200),
            'category_id' => Category::all()->random()->id,
            'seller' => User::all()->random()->id,
            'image' => 'product-image-placeholder.jpeg',
            'stock' => fake()->numberBetween(1, 100),
        ];
    }
}
