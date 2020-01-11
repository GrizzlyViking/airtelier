<?php

namespace Tests\Feature;

use App\Models\Address;
use App\Models\Countries;
use App\Models\Currency;
use App\Models\Event;
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
        	'paid_for_type' => Resource::class,
			'paid_for_id' => $resource->id,
			'currency' => $currency,
			'exchange_rate' => $exchange_rate
		]);

        $random = $resource->transactions()->get()->random();

        $this->assertDatabaseHas('transactions', $random->toArray());
    }
}
