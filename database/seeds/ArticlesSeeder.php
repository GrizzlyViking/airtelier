<?php

use App\Models\Address;
use App\Models\Article;
use App\Models\Event;
use App\Models\Offer;
use App\Models\Review;
use Illuminate\Database\Seeder;

class ArticlesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Article::class, 20)->create()->each(function (Article $article) {
            $article->offers()->saveMany(factory(Offer::class, rand(1, 3))->create()->each(function(Offer $offer) {
            	$address = factory(Address::class)->create();
				if ($offer->addresses->count() === 0) {
					$offer->addresses()->attach($address);
				}
				if ($offer->author->addresses->count() === 0) {
					$offer->author->addresses()->attach($address);
				}

                factory(Review::class, rand(0,15))->make()->each(function (Review $review) use ($offer) {
                    $offer->reviews()->save($review);
                });
            }));
            $article->events()->attach(
                factory(Event::class, rand(0, 3))
                    ->create(['owner_id' => $article->author_id])
                    ->each(function (Event $event) {
						$address = factory(Address::class)->create();
						if ($event->addresses->count() === 0) {
							$event->addresses()->attach($address);
						}
						if ($event->owner->addresses->count() === 0) {
							$event->owner->addresses()->attach($address);
						}

                        factory(Review::class, rand(0,15))->make()->each(function (Review $review) use ($event) {
                            $event->reviews()->save($review);
                        });
                    })
            );
        });

    }
}
