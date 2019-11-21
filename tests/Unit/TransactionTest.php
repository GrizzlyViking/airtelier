<?php

namespace Tests\Feature;

use App\Models\Address;
use App\Models\Countries;
use App\Models\Event;
use App\Models\Offer;
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
        $exchange_rate = Countries::where('currency_code', $currency)->first()->exchange_rate;

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
    public function attach_many_transactions_to_an_offer()
    {
    	/** @var Offer $event */
        $offer = factory(Offer::class)->create();
        /** @var Address $address */
        $currency = 'DKK';
        $exchange_rate = Countries::where('currency_code', $currency)->first()->exchange_rate;

        factory(Transaction::class, rand(100,500))->create([
        	'paid_for_type' => Offer::class,
			'paid_for_id' => $offer->id,
			'currency' => $currency,
			'exchange_rate' => $exchange_rate
		]);

        $random = $offer->transactions()->get()->random();

        $this->assertDatabaseHas('transactions', $random->toArray());
    }
}
