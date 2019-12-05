<?php

use App\Models\Address;
use App\Models\Article;
use App\Models\Event;
use App\Models\Image;
use App\Models\Offer;
use App\Models\Price;
use App\Models\Review;
use App\Models\Transaction;
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
        	/** @var Address $address */
			$address = factory(Address::class)->create();
			$article->offers()
				->saveMany(factory(Offer::class, rand(1, 3))
					->create()
					->each(function (Offer $offer) use ($address) {
						$this->addSharedModels($offer, $address);
					}));
            $article->events()->attach(
                factory(Event::class, rand(0, 3))
                    ->create(['owner_id' => $article->author_id])
                    ->each(function (Event $event) use ($address) {
						$this->addSharedModels($event, $address);
                    })
            );
        });

    }

	/**
	 * @param Offer|Event $element
	 * @param Address $address
	 */
	protected function addAddress($element, $address): void
	{
		if ($element->addresses->count() === 0) {
			$element->addresses()->attach($address);
		}
		if ($element->owner->addresses->count() === 0) {
			$element->owner->addresses()->attach($address);
		}
	}

	/**
	 * @param Offer|Event   $element
	 * @param Address $address
	 */
	protected function addSharedModels($element, Address $address)
	{
		$this->addAddress($element, $address);

		$element->price()->save(factory(Price::class)->make());

		$element->transactions()->saveMany(
			factory(Transaction::class, rand(10, 100))->make([
				'currency'      => $address->country->currency_code,
			])->sortBy('created_at')
		);

		$element->gallery()->save(factory(Image::class)->make(), ['purpose' => 'compact']);

		$element->reviews()->saveMany(factory(Review::class, rand(0,15))->make());
	}
}
