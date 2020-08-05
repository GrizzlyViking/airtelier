<?php

namespace Tests\Feature;

use App\Models\Address;
use App\Models\Countries;
use App\Models\Currency;
use App\Models\Event;
use App\Models\Price;
use App\Models\Resource;
use App\Models\Transaction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TransactionTest extends TestCase
{
	use RefreshDatabase;

	/**
	 * @test
	 */
    public function attach_many_transactions_to_an_event()
    {
    	/** @var Event $event */
        $event = factory(Event::class)->create();
        /** @var Address $address */
        $currency = 'DKK';
        $exchange_rate = Currency::findOrFail($currency)->exchange_rate;

        factory(Transaction::class, rand(100,500))->create([
        	'paid_for_type' => Event::class,
			'paid_for_id' => $event->id,
			'currency' => $currency,
			'exchange_rate' => $exchange_rate
		]);

        $random = $event->transactions()->get()->random();

        $this->assertDatabaseHas('transactions', $random->toArray());
    }

	/**
	 * @test
	 */
    public function attach_many_transactions_to_an_resource()
    {
    	/** @var Resource $event */
        $resource = factory(Resource::class)->create();
        /** @var Address $address */
        $currency = 'DKK';
        $exchange_rate = Currency::findOrFail( $currency)->exchange_rate;

        factory(Transaction::class, rand(100,500))->create([
        	'paid_for_type' => $resource->getMorphClass(),
			'paid_for_id' => $resource->getKey(),
			'currency' => $currency,
			'exchange_rate' => $exchange_rate
		]);

        $random = $resource->transactions()->get()->random();

        $this->assertDatabaseHas('transactions', $random->toArray());
    }

    /** @test */
	public function sell_a_scheduled_event()
	{
		/** @var Resource $event */
		$resource = factory(Resource::class)->create();
		/** @var Price $price */
		$resource->price()->save($price = factory(Price::class)->make());
		/** @var Transaction $transaction */
		$transaction = factory(Transaction::class)->create([
			'paid_for_type' => $resource->getMorphClass(),
			'paid_for_id'   => $resource->getKey(),
			'currency'      => $price->currency->code,
			'exchange_rate' => $price->currency->exchange_rate
		]);
		$this->assertDatabaseHas('transactions', $transaction->toArray());
	}
}
