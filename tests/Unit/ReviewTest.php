<?php

namespace Tests\Feature;

use App\Models\Resource;
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
    public function create_review_and_attach_it_to_resource()
    {
        $review = factory(Review::class)->make();
        $resource = factory(Resource::class)->create();
        $resource->reviews()->save($review);

        $this->assertDatabaseHas('reviews', [
            'id' => $review->id,
            'author_id' => $review->author_id,
        ]);
        /** @var Review $review */
        $review = $resource->reviews->first();
        $this->assertDatabaseHas('reviews', ['description' => $review->description]);
    }
}
