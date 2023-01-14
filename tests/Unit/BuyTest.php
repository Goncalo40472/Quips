<?php

namespace Tests\Unit;

use App\Models\Buy;
use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

final class BuyTest extends TestCase
{

    /* Test if the user_id is the same as the one inserted */

    /*public function testBuyHasWrongUserId()
    {
        $buy = new Buy([
            'user_id' => 1,
        ]);

        $this->assertEquals(2, $buy->user_id);
    }*/

    public function testBuyHasUserId()
    {
        $buy = new Buy([
            'user_id' => 1,
        ]);

        $this->assertEquals(1, $buy->user_id);
    }

    /* Test if the total is the same as the one inserted */

    /*public function testBuyHasWrongTotal()
    {
        $buy = new Buy([
            'total' => 10.00,
        ]);

        $this->assertEquals(20.00, $buy->total);
    }*/

    public function testBuyHasTotal()
    {
        $buy = new Buy([
            'total' => 10.00,
        ]);

        $this->assertEquals(10.00, $buy->total);
    }

    /* Test if the creation of a buy */

    public function testCreateBuy()
    {
        $buy = new Buy([
            'user_id' => 1,
            'total' => 10.00,
        ]);

        $this->assertInstanceOf(Buy::class, $buy);
        $this->assertEquals(1, $buy->user_id);
        $this->assertEquals(10.00, $buy->total);
    }
}