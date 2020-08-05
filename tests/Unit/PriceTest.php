<?php

namespace Tests\Unit;

use App\Models\Currency;
use App\Models\Event;
use App\Models\Resource;
use App\Models\Price;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Arr;
use Tests\TestCase;

class PriceTest extends TestCase
{
	use RefreshDatabase;

    /**
     * A basic unit test example.
     * @test
     * @return void
     */
    public function attach_a_price_to_an_resource()
    {
    	$resource = factory(Resource::class)->create();

    	$price = factory(Price::class)->make();

    	$resource->price()->save($price);

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
	public function get_value_of_resource()
	{
		$resource = factory(Resource::class)->create();

		$price = factory(Price::class)->make();

		$resource->price()->save($price);

		$this->assertIsFloat($resource->price->amount);
    }

    /** @test */
	public function get_tax_resource()
	{
		/** @var Resource $resource */
		$resource = factory(Resource::class)->create();

		/** @var Price $price */
		$price = factory(Price::class)->make();

		$resource->price()->save($price);

		$this->assertIsFloat($resource->price->tax);
		$this->assertEquals($resource->price->amount * $resource->price->tax_rate, $resource->price->tax);
    }

    /** @test */
	public function get_currency()
	{
		/** @var Resource $resource */
		$resource = factory(Resource::class)->create();

		/** @var Price $price */
		$price = factory(Price::class)->make();

		$resource->price()->save($price);

		$this->assertIsFloat($resource->price->currency->exchange_rate);
	}

    /** @test */
	public function convert_currency()
	{
		/** @var Resource $resource */
		$resource = factory(Resource::class)->create();

		/** @var Price $price */
		$price = factory(Price::class)->make([
			'currency_code' => 'USD'
		]);

		$resource->price()->save($price);
		/** @var Currency $currency */
		$currency = Currency::findOrFail('DKK');

		$usd_exchange_rate = $resource->price->currency->exchange_rate;
		$dkk_exchange_rate = $currency->exchange_rate;
		$expected = round($resource->price->amount * $dkk_exchange_rate/$usd_exchange_rate, 2);

		$dkk = $resource->price->convertTo($currency);
		$this->assertEquals($expected, $dkk);
	}
}
