<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Product;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cart>
 */
class CartFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        $product_id = Product::all()->random()->id;
        $quantity = $this->faker->numberBetween(1, 10);

        return [
            'user_id' => User::all()->random()->id,
            'product_id' => $product_id,
            'quantity' => $quantity,
            'price' => Product::where('id', $product_id)->first()->price * $quantity,
        ];
    }
}
