<?php

namespace Tests\Unit;

use App\Models\Event;
use App\Models\Resource;
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
}
