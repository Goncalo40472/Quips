<?php

namespace Tests\Unit;

use App\Models\Review;
use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

final class ReviewTest extends TestCase
{

    /* Test if the title is the same as the one inserted */

    /*public function testReviewHasWrongTitle()
    {
        $review = new Review([
            'title' => 'Review 1',
        ]);

        $this->assertEquals('Review 2', $review->title);
    }*/

    public function testReviewHasTitle()
    {
        $review = new Review([
            'title' => 'Review 1',
        ]);

        $this->assertEquals('Review 1', $review->title);
    }

    /* Test if the comment is the same as the one inserted */

    /*public function testReviewHasWrongComment()
    {
        $review = new Review([
            'comment' => 'Comment 1',
        ]);

        $this->assertEquals('Comment 2', $review->comment);
    }*/

    public function testReviewHasComment()
    {
        $review = new Review([
            'comment' => 'Comment 1',
        ]);

        $this->assertEquals('Comment 1', $review->comment);
    }

    /* Test if the rating is the same as the one inserted */

    /*public function testReviewHasWrongRating()
    {
        $review = new Review([
            'rating' => 1,
        ]);

        $this->assertEquals(2, $review->rating);
    }*/

    public function testReviewHasRating()
    {
        $review = new Review([
            'rating' => 1,
        ]);

        $this->assertEquals(1, $review->rating);
    }

    /* Test if the user_id is the same as the one inserted */

    /*public function testReviewHasWrongUserId()
    {
        $review = new Review([
            'user_id' => 1,
        ]);

        $this->assertEquals(2, $review->user_id);
    }*/

    public function testReviewHasUserId()
    {
        $review = new Review([
            'user_id' => 1,
        ]);

        $this->assertEquals(1, $review->user_id);
    }

    /* Test if the product_id is the same as the one inserted */

    /*public function testReviewHasWrongProductId()
    {
        $review = new Review([
            'product_id' => 1,
        ]);

        $this->assertEquals(2, $review->product_id);
    } */ 

    public function testReviewHasProductId()
    {
        $review = new Review([
            'product_id' => 1,
        ]);

        $this->assertEquals(1, $review->product_id);
    }

    /* Test the creation of a review */

    public function testReviewCreation()
    {
        $review = new Review([
            'title' => 'Review 1',
            'comment' => 'Comment 1',
            'rating' => 1,
            'user_id' => 1,
            'product_id' => 1,
        ]);

        $this->assertInstanceOf(Review::class, $review);
        $this->assertEquals('Review 1', $review->title);
        $this->assertEquals('Comment 1', $review->comment);
        $this->assertEquals(1, $review->rating);
        $this->assertEquals(1, $review->user_id);
        $this->assertEquals(1, $review->product_id);
    }

}