<?php

namespace Tests\Feature;

use App\Interfaces\Sellable;
use App\Models\Cart;
use App\Models\Event;
use App\Models\Offer;
use App\Models\Price;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CartTest extends TestCase
{
	use RefreshDatabase;

    /**
     * A basic feature test example.
     * @test
     * @return void
     */
    public function add_event_to_cart()
    {
    	$class = Event::class;
    	/** @var Event $item */
		$item = factory($class)->create();
		$item->price()->save(factory(Price::class)->make());
		$response = $this->post('/cart/add', [
			'item_type' => $class,
			'item_id' => $item->id,
			'quantity' => 1,
		]);

		$this->assertDatabaseHas('cart_items', [
			'item_type' => $class,
			'item_id' => $item->id,
			'quantity' => 1,
		]);

		/** @var Cart $cart */
		$cart = session()->get('cart');
		$event = $cart->basket()->first();
		$this->assertTrue($event instanceof Event);
		$this->assertIsFloat($cart->total());

		$response->assertStatus(200);
    }

    /**
     * A basic feature test example.
     * @test
     * @return void
     */
    public function add_offer_to_cart()
    {
    	$class = Offer::class;
		$item = factory($class)->create();
		$item->price()->save(factory(Price::class)->make());
		$response = $this->post('/cart/add', [
			'item_type' => $class,
			'item_id' => $item->id,
			'quantity' => 1,
		]);

		$this->assertDatabaseHas('cart_items', [
			'item_type' => $class,
			'item_id' => $item->id,
			'quantity' => 1,
		]);

		/** @var Cart $cart */
		$cart = session()->get('cart');
		$event = $cart->basket()->first();
		$this->assertTrue($event instanceof Offer);
		$this->assertIsFloat($cart->total());

		$response->assertStatus(200);
    }

    /**
     * A basic feature test example.
     * @test
     * @return void
     */
    public function add_offer_and_event_to_cart()
    {
		$offer = factory(Offer::class)->create();
		$offer->price()->save(factory(Price::class)->make());

		$response = $this->post('/cart/add', [
			'item_type' => Offer::class,
			'item_id' => $offer->id,
			'quantity' => 4,
		]);

		$response->assertStatus(200);

		$this->assertDatabaseHas('cart_items', [
			'item_type' => Offer::class,
			'item_id' => $offer->id,
			'quantity' => 4,
		]);

		$event = factory(Event::class)->create();
		$event->price()->save(factory(Price::class)->make());

		$response = $this->post('/cart/add', [
			'item_type' => Event::class,
			'item_id' => $event->id,
			'quantity' => 9,
		]);

		$response->assertStatus(200);

		$this->assertDatabaseHas('cart_items', [
			'item_type' => Event::class,
			'item_id' => $event->id,
			'quantity' => 9,
		]);

		/** @var Cart $cart */
		$cart = session()->get('cart');
		$this->assertEquals(9+4, $cart->count());
		$this->assertEquals(2,  $cart->basket()->count());
    }

	/** @test */
	public function retrieve_more_items_from_basket()
	{
		collect($classes = [
			Offer::class,
			Offer::class,
			Event::class,
			Offer::class,
			Event::class,
		])->each(function ($class) {
			$model = factory($class)->create();
			$response = $this->post('/cart/add', [
				'item_type' => $class,
				'item_id' => $model->id,
				'quantity' => $quantity = rand(1,7),
			]);

			$response->assertStatus(200);

			$this->assertDatabaseHas('cart_items', [
				'item_type' => $class,
				'item_id' => $model->id,
				'quantity' => $quantity
			]);

			$response->assertSessionHas('cart');

			$json = $this->get('/cart/basket');
			$json->assertStatus(200);
			$json->assertJsonFragment([
				'slug' => $model->slug,
			]);
		});

		$cart = session('cart');
		$cart->load('items');
		$this->assertEquals(count($classes), $cart->basket()->count());
	}
}
