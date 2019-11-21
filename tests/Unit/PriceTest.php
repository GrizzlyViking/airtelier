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

    	$offer->prices()->save($price);

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

    	$event->prices()->save($price);
    	$this->assertDatabaseHas('prices', $price->toArray());
    }
}
