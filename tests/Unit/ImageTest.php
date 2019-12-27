<?php

namespace Tests\Unit;

use App\Models\Article;
use App\Models\Image;
use App\Models\Resource;
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
	public function attach_image_to_resource()
	{
		/** @var Resource $resource */
		$resource = factory(Resource::class)->create();
		$image = factory(Image::class)->create([
			'owner_id' => $resource->owner_id
		]);

		$resource->gallery()->attach($image, ['purpose' => 'compact']);

		$this->assertTrue(true);
	}
}
