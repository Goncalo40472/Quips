<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use Tests\TestCase;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

final class ProductTest extends TestCase
{
    
    public function testSearchProducts()
    {

        $response = $this->get('/search', [
            'search' => 'test',
        ]);

        $response->assertStatus(200);

    }

    public function testShowProduct()
    {

        $user = User::factory()->create();

        $product = Product::factory()->create();

        $response = $this->actingAs($user)->get('/products/show/'.$product->id);

        $response->assertStatus(200);

    }

    public function testCreateProduct()
    {

        $user = User::factory()->create();

        $category = new Category();
        $category->name = 'test';
        $category->save();

        Storage::fake('local');
        $image = UploadedFile::fake()->create('image.jpg', 1000, 'image/jpeg');

        $response = $this->actingAs($user)->post('/products', [
            'name' => 'test',
            'description' => 'test',
            'price' => 1,
            'category' => $category->id,
            'image' => $image,
            'stock' => 1,
            'seller' => $user->id,
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('products', [
            'name' => 'test',
            'description' => 'test',
            'price' => 1,
            'category_id' => $category->id,
            'image' => $image->hashName(),
            'stock' => 1,
            'seller' => $user->id,
        ]);

    }

    public function testEditProduct()
    {

        $user = User::factory()->create();

        $category = new Category();
        $category->name = 'test';
        $category->save();

        $product = Product::factory()->create([
            'seller' => $user->id,
        ]);

        Storage::fake('local');
        $image = UploadedFile::fake()->create('image.jpg', 1000, 'image/jpeg');

        $response = $this->actingAs($user)->post('/products/'.$product->id, [
            'name' => 'test',
            'description' => 'test',
            'price' => 1,
            'category' => $category->id,
            'image' => $image,
            'stock' => 1,
            'seller' => $user->id,
        ]);

        $response->assertStatus(302);

        $this->assertDatabaseHas('products', [
            'name' => 'test',
            'description' => 'test',
            'price' => 1,
            'category_id' => $category->id,
            'image' => $image->hashName(),
            'stock' => 1,
            'seller' => $user->id,
        ]);

    }

}