<?php

namespace Tests\Unit;

use App\Models\Article;
use App\Models\Image;
use App\Models\Offer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ImageTest extends TestCase
{
	use RefreshDatabase;

	/**
	 * A basic unit test example.
	 *
	 * @test
	 * @return void
	 */
	public function attach_image_to_article()
	{
		/** @var Article $article */
		$article = factory(Article::class)->create();
		$image = factory(Image::class)->create([
			'owner_id' => $article->author_id
		]);

		$article->gallery()->attach($image, ['purpose' => 'compact']);

		$this->assertDatabaseHas('images', $image->toArray());
		$this->assertDatabaseHas('gallery', [
			'image_id'      => $image->id,
			'relation_type' => Article::class,
			'relation_id'   => $article->id,
		]);
	}

	/**
	 * A basic unit test example.
	 *
	 * @test
	 * @return void
	 */
	public function attach_image_to_offer()
	{
		/** @var Offer $offer */
		$offer = factory(Offer::class)->create();
		$image = factory(Image::class)->create([
			'owner_id' => $offer->owner_id
		]);

		$offer->gallery()->attach($image, ['purpose' => 'compact']);

		$this->assertTrue(true);
	}
}
