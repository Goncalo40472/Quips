<?php

namespace Tests\Unit;

use App\Models\Cart;
use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

final class CartTest extends TestCase
{

    /* Test if the user_id is the same as the one inserted */

    /*public function testCartHasWrongUserId()
    {
        $cart = new Cart([
            'user_id' => 1,
        ]);

        $this->assertEquals(2, $cart->user_id);
    }*/

    public function testCartHasUserId()
    {
        $cart = new Cart([
            'user_id' => 1,
        ]);

        $this->assertEquals(1, $cart->user_id);
    }

    /* Test if the product_id is the same as the one inserted */

    /*public function testCartHasWrongProductId()
    {
        $cart = new Cart([
            'product_id' => 1,
        ]);

        $this->assertEquals(2, $cart->product_id);
    }*/

    public function testCartHasProductId()
    {
        $cart = new Cart([
            'product_id' => 1,
        ]);

        $this->assertEquals(1, $cart->product_id);
    }

    /* Test if the quantity is the same as the one inserted */

    /*public function testCartHasWrongQuantity()
    {
        $cart = new Cart([
            'quantity' => 1,
        ]);

        $this->assertEquals(2, $cart->quantity);
    }*/

    public function testCartHasQuantity()
    {
        $cart = new Cart([
            'quantity' => 1,
        ]);

        $this->assertEquals(1, $cart->quantity);
    }

    /* Test if the price is the same as the one inserted */

    /*public function testCartHasWrongPrice()
    {
        $cart = new Cart([
            'price' => 10.00,
        ]);

        $this->assertEquals(20.00, $cart->price);
    }*/

    public function testCartHasPrice()
    {
        $cart = new Cart([
            'price' => 10.00,
        ]);

        $this->assertEquals(10.00, $cart->price);
    }

    /* Test the creation of a cart */

    public function testCreateCart()
    {
        $cart = new Cart([
            'user_id' => 1,
            'product_id' => 1,
            'quantity' => 1,
            'price' => 10.00,
        ]);

        $this->assertEquals(1, $cart->user_id);
        $this->assertEquals(1, $cart->product_id);
        $this->assertEquals(1, $cart->quantity);
        $this->assertEquals(10.00, $cart->price);
    }

}