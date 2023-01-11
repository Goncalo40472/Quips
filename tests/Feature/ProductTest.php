<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use App\Models\Category;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

final class ProductTest extends TestCase
{
    public function testCreateProduct()
    {
        $product = new Product([
            'name' => 'Product 1',
            'description' => 'Product 1 description',
            'price' => 10.00,
            //'stock' => 10,
            'seller' => 1,
            'image' => 'image.jpg',
            'category_id' => 1,
        ]);

        $this->assertInstanceOf(Product::class, $product);
        $this->assertEquals('Product 1', $product->name);
        $this->assertEquals('Product 1 description', $product->description);
        $this->assertEquals(10.00, $product->price);
        //$this->assertEquals(10, $product->stock);
        $this->assertEquals(1, $product->seller);
        $this->assertEquals('image.jpg', $product->image);
        $this->assertEquals(1, $product->category_id);
    }

    /*public function testSaveProductDB()
    {
        $product = new Product([
            'name' => fake()->text(35),
            'description' => fake()->text(200),
            'price' => fake()->randomFloat(2, 0, 200),
            //'stock' => fake()->numberBetween(0, 100),
            'category_id' => Category::all()->random()->id,
            'seller' => User::all()->random()->id,
            'image' => 'product-image-placeholder.jpeg',
        ]);

        $product->save();
        $this->assertDatabaseHas('products', $product->toArray());
    }*/

}

