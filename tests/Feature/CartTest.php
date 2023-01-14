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

}