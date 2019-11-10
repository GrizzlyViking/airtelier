<?php

namespace Tests\Feature;

use App\Models\Offer;
use App\Models\Review;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReviewTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     * @test
     * @return void
     */
    public function create_review_and_attach_it_to_offer()
    {
        $review = factory(Review::class)->make();
        $offer = factory(Offer::class)->create();
        $offer->reviews()->save($review);

        $this->assertDatabaseHas('reviews', [
            'id' => $review->id,
            'author_id' => $review->author_id,
        ]);
        /** @var Review $review */
        $review = $offer->reviews->first();
        $this->assertDatabaseHas('reviews', ['description' => $review->description]);
    }
}
