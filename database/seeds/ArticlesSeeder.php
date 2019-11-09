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
            $article->offers()->attach(factory(Address::class)->create());
            $article->offers()->attach(factory(Offer::class, rand(1, 3))->create()->each(function(Offer $offer) {
                factory(Review::class, rand(0,15))->make()->each(function (Review $review) use ($offer) {
                    $offer->reviews()->save($review);
                });
            }));
            $article->events()->attach(
                factory(Event::class, rand(0, 3))
                    ->create(['owner_id' => $article->author_id])
                    ->each(function (Event $event) {
                        factory(Review::class, rand(0,15))->make()->each(function (Review $review) use ($event) {
                            $event->reviews()->save($review);
                        });
                    })
            );
        });
    }
}
