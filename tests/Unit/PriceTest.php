<?php

namespace Tests\Unit;

use App\Models\Event;
use App\Models\Offer;
use App\Models\Price;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PriceTest extends TestCase
{
	use RefreshDatabase;

    /**
     * A basic unit test example.
     * @test
     * @return void
     */
    public function attach_a_price_to_an_offer()
    {
    	$offer = factory(Offer::class)->create();

    	$price = factory(Price::class)->make();

    	$offer->price()->save($price);

    	$this->assertDatabaseHas('prices', $price->toArray());
    }

    /**
     * A basic unit test example.
     * @test
     * @return void
     */
    public function attach_a_price_to_an_event()
    {
    	$event = factory(Event::class)->create();

    	$price = factory(Price::class)->make();

    	$event->price()->save($price);
    	$this->assertDatabaseHas('prices', $price->toArray());
    }

    /** @test */
	public function get_value_of_offer()
	{
		$offer = factory(Offer::class)->create();

		$price = factory(Price::class)->make();

		$offer->price()->save($price);

		$this->assertIsFloat($offer->price->amount);
    }

    /** @test */
	public function get_tax_offer()
	{
		/** @var Offer $offer */
		$offer = factory(Offer::class)->create();

		/** @var Price $price */
		$price = factory(Price::class)->make();

		$offer->price()->save($price);

		$this->assertIsFloat($offer->price->tax);
		$this->assertEquals($offer->price->amount * $offer->price->tax_rate, $offer->price->tax);
    }
}
