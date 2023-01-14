<?php

namespace Tests\Unit;

use App\Models\Product;
use App\Models\User;
use App\Models\Category;
use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

final class ProductTest extends TestCase
{

    /* Test if the name is the same as the one inserted */

    /*public function testProductHasWrongName()
    {
        $product = new Product([
            'name' => 'Product 1',
        ]);

        $this->assertEquals('Product 2', $product->name);
    }*/

    public function testProductHasName()
    {
        $product = new Product([
            'name' => 'Product 1',
        ]);

        $this->assertEquals('Product 1', $product->name);
    }

    /* Test if the description is the same as the one inserted */

    /*public function testProductHasWrongDescription()
    {
        $product = new Product([
            'description' => 'Product 1 description',
        ]);

        $this->assertEquals('Product 2 description', $product->description);
    }*/

    public function testProductHasDescription()
    {
        $product = new Product([
            'description' => 'Product 1 description',
        ]);

        $this->assertEquals('Product 1 description', $product->description);
    }

    /* Test if the price is the same as the one inserted */

    /*public function testProductHasWrongPrice()
    {
        $product = new Product([
            'price' => 10.00,
        ]);

        $this->assertEquals(20.00, $product->price);
    }*/

    public function testProductHasPrice()
    {
        $product = new Product([
            'price' => 10.00,
        ]);

        $this->assertEquals(10.00, $product->price);
    }

    /* Test if the stock is the same as the one inserted */

    /*public function testProductHasWrongStock()
    {
        $product = new Product([
            'stock' => 10,
        ]);

        $this->assertEquals(20, $product->stock);
    }*/

    public function testProductHasStock()
    {
        $product = new Product([
            'stock' => 10,
        ]);

        $this->assertEquals(10, $product->stock);
    }

    /* Test if the seller is the same as the one inserted */

    /*public function testProductHasWrongSeller()
    {
        $product = new Product([
            'seller' => 1,
        ]);

        $this->assertEquals(2, $product->seller);
    }*/

    public function testProductHasSeller()
    {
        $product = new Product([
            'seller' => 1,
        ]);

        $this->assertEquals(1, $product->seller);
    }

    /* Test if the image is the same as the one inserted */

    /*public function testProductHasWrongImage()
    {
        $product = new Product([
            'image' => 'image.jpg',
        ]);

        $this->assertEquals('image2.jpg', $product->image);
    }*/

    public function testProductHasImage()
    {
        $product = new Product([
            'image' => 'image.jpg',
        ]);

        $this->assertEquals('image.jpg', $product->image);
    }

    /* Test if the category is the same as the one inserted */

    /*public function testProductHasWrongCategory()
    {
        $product = new Product([
            'category_id' => 1,
        ]);

        $this->assertEquals(2, $product->category_id);
    }*/

    public function testProductHasCategory()
    {
        $product = new Product([
            'category_id' => 1,
        ]);

        $this->assertEquals(1, $product->category_id);
    }

    /* Test the creation of a product */

    public function testCreateProduct()
    {
        $product = new Product([
            'name' => 'Product 1',
            'description' => 'Product 1 description',
            'price' => 10.00,
            'stock' => 10,
            'seller' => 1,
            'image' => 'image.jpg',
            'category_id' => 1,
        ]);

        $this->assertInstanceOf(Product::class, $product);
        $this->assertEquals('Product 1', $product->name);
        $this->assertEquals('Product 1 description', $product->description);
        $this->assertEquals(10.00, $product->price);
        $this->assertEquals(10, $product->stock);
        $this->assertEquals(1, $product->seller);
        $this->assertEquals('image.jpg', $product->image);
        $this->assertEquals(1, $product->category_id);
    }

}

