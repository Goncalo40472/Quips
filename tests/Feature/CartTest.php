<?php

namespace Tests\Feature;

use App\Models\Cart;
use App\Models\User;
use App\Models\Product;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

final class CartTest extends TestCase
{

    /*public function testAddProductToCart()
    {

        $product = Product::factory()->create();

        $response = $this->post('/cart/addProduct/', [
            'product' => $product,
            'quantity' => 1,
        ]);

        $response->assertStatus(200);

    }*/

    public function testGetCart()
    {

        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/cart');

        $response->assertStatus(200);

    }

}