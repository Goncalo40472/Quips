<?php

namespace Tests\Unit;

use App\Models\Category;
use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

final class CategoryTest extends TestCase
{

    /* Test if the name is the same as the one inserted */

    /*public function testCategoryHasWrongName()
    {
        $category = new Category([
            'name' => 'Category 1',
        ]);

        $this->assertEquals('Category 2', $category->name);
    }*/

    public function testCategoryHasName()
    {
        $category = new Category([
            'name' => 'Category 1',
        ]);

        $this->assertEquals('Category 1', $category->name);
    }

    /* Test the creation of a category */

    public function testCategoryCreation()
    {
        $category = new Category([
            'name' => 'Category 1',
        ]);

        $this->assertInstanceOf(Category::class, $category);
        $this->assertEquals('Category 1', $category->name);
    }

}