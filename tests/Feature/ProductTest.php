<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use Tests\TestCase;

final class ProductTest extends TestCase
{
    
    public function testSaveProductDB()
    {
        $product = new Product([
            'name' => fake()->text(35),
            'description' => fake()->text(200),
            'price' => fake()->randomFloat(2, 0, 200),
            'stock' => fake()->numberBetween(0, 100),
            'category_id' => Category::all()->random()->id,
            'seller' => User::all()->random()->id,
            'image' => 'product-image-placeholder.jpeg',
        ]);

        $product->save();
        $this->assertDatabaseHas('products', $product->toArray());
    }

}