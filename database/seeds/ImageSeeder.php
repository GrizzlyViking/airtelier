<?php

use App\Models\Article;
use App\Models\Event;
use App\Models\Image;
use App\Models\Resource;
use Illuminate\Database\Seeder;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	factory(Image::class, 20)->create()->each(function (Image $image) {
    		switch (rand(1,4)) {
				case 1:
					/** @var Article $article */
					$article = Article::all()->random();
					$article->gallery()->attach($image, ['purpose' => 'compact']);
				case 2:
				case 3:
					/** @var Resource $resource */
					$resource = Resource::all()->random();
					$resource->gallery()->attach($image, ['purpose' => 'compact']);
					break;
				case 4:
					/** @var Event $event */
					$event = Event::all()->random();
					$event->gallery()->attach($image, ['purpose' => 'compact']);
					break;
			}
		});
    }
}
