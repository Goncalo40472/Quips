<?php

namespace Tests\Feature;

use App\Models\Cart;
use App\Models\User;
use App\Models\Product;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

final class CartTest extends TestCase
{

    public function testGetCart()
    {

        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/cart');

        $response->assertStatus(200);

    }

    public function testAddProductToCart()
    {

        $user = User::factory()->create();

        $product = Product::factory()->create();

        $response = $this->actingAs($user)->post('/cart/addProduct/'.$product->id, [
            'quantity' => 1,
        ]);

        $response->assertStatus(302);

        $this->assertDatabaseHas('carts', [
            'user_id' => $user->id,
            'product_id' => $product->id,
            'quantity' => 1,
            'price' => $product->price,
        ]);

    }

    public function testRemoveProductFromCart()
    {

        $user = User::factory()->create();

        $product = Product::factory()->create();

        $cart = Cart::factory()->create([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'quantity' => 1,
            'price' => $product->price,
        ]);

        $response = $this->actingAs($user)->post('/cart/removeProduct/'.$product->id);

        $response->assertStatus(302);

        $this->assertDatabaseMissing('carts', [
            'user_id' => $user->id,
            'product_id' => $product->id,
            'quantity' => 1,
            'price' => $product->price,
        ]);

    }

    public function testAlterProductQuantityCart()
    {

        $user = User::factory()->create();

        $product = Product::factory()->create();

        $cart = Cart::factory()->create([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'quantity' => 1,
            'price' => $product->price,
        ]);

        $response = $this->actingAs($user)->post('/cart/productQuantity/'.$product->id, [
            'quantity' => 2,
        ]);

        $response->assertStatus(302);

        $this->assertDatabaseHas('carts', [
            'user_id' => $user->id,
            'product_id' => $product->id,
            'quantity' => 2,
            'price' => $product->price * 2,
        ]);

    }

    public function testCartCheckout()
    {

        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/cart/checkout');

        $response->assertStatus(200);

    }

}