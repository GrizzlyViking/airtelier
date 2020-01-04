<?php

namespace Tests\Unit;

use App\Interfaces\Sellable;
use App\Models\Cart;
use App\Models\Event;
use App\Models\Message;
use App\Models\Resource;
use App\Models\Price;
use App\Models\User;
use Facades\App\Models\Cart as FacadeCart;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CartTest extends TestCase
{
	use RefreshDatabase;

	/** @test */
	public function guest_adds_items_to_cart()
	{
		collect([
			Resource::class,
			Event::class,
		])->each(function ($class) {
			$item = factory($class)->create();
			FacadeCart::add($item, 7);

			$this->assertDatabaseHas('cart_items', [
				'item_type' => $class,
				'item_id' => $item->id
			]);
		});
	}

    /**
     * A basic unit test example.
     * @test
     * @return void
     */
    public function add_resource_to_cart()
    {
    	$resource = factory(Resource::class)->create();
    	$user = factory(User::class)->create();
    	$this->be($user);

    	$cart = new Cart();
    	$cart->add($resource);

    	$this->assertDatabaseHas('cart_items', [
    		'item_type' => Resource::class,
			'item_id' => $resource->id
		]);
    }

    /** @test */
	public function add_quantity_of_events_to_cart()
	{
		$event = factory(Event::class)->create();
		$user = factory(User::class)->create();
		$this->be($user);

		$cart = new Cart();
		$cart->add($event, 3);

		$this->assertDatabaseHas('carts', [
			'id' => $cart->id,
			'user_id' => $user->id,
		]);

		$this->assertDatabaseHas('cart_items', [
			'cart_id' => $cart->id,
			'item_type' => Event::class,
			'item_id' => $event->id,
			'quantity' => 3
		]);
    }

	/** @test */
	public function get_the_basket_content()
	{
		/** @var Event $event */
		$event = factory(Event::class)->create();
		$user = factory(User::class)->create();
		$this->be($user);

		$cart = new Cart();
		$cart->add($event, 3);

		$event->setAttribute('quantity', 3);

		$this->assertEquals($event->toArray(), $cart->basket()->first()->toArray());
	}

	/** @test */
	public function add_two_different_items_cart()
	{
		/** @var Event $event */
		$event = factory(Event::class)->create();
		/** @var Resource $resource */
		$resource = factory(Resource::class)->create();
		/** @var User $user */
		$user = factory(User::class)->create();
		$this->be($user);

		$cart = new Cart();
		$cart->add([
			['item' => $event, 'quantity' => 3],
			['item' => $resource, 'quantity' => 4]
		]);

		$this->assertDatabaseHas('cart_items', [
			'cart_id' => $cart->id,
			'item_type' => Event::class,
			'item_id' => $event->id,
			'quantity' => 3
		]);

		$this->assertDatabaseHas('cart_items', [
			'cart_id' => $cart->id,
			'item_type' => Resource::class,
			'item_id' => $resource->id,
			'quantity' => 4
		]);
	}

	/** @test */
	public function should_add_only_valid_items()
	{
		/** @var Event $event */
		$event = factory(Event::class)->create();
		/** @var Resource $resource */
		$resource = factory(Resource::class)->create();
		/** @var Message $message */
		$message = factory(Message::class)->create();
		/** @var User $user */
		$user = factory(User::class)->create();
		$this->be($user);

		$cart = new Cart();

		$cart->add([
			['item' => $event, 'quantity' => 3],
			['item' => $message, 'quantity' => 4],
			['item' => $resource, 'quantity' => 'not integer']
		]);

		$this->assertDatabaseHas('cart_items', [
			'cart_id' => $cart->id,
			'item_type' => Event::class,
			'item_id' => $event->id,
			'quantity' => 3
		]);

		$this->assertDatabaseMissing('cart_items', [
			'cart_id' => $cart->id,
			'item_type' => Message::class,
			'item_id' => $message->id,
			'quantity' => 4
		]);

		$this->assertDatabaseMissing('cart_items', [
			'cart_id' => $cart->id,
			'item_type' => Resource::class,
			'item_id' => $resource->id,
		]);
	}

	/** @test */
	public function get_value_of_item_in_cart()
	{
		/** @var Event $event */
		$event = factory(Event::class)->create();
		$event->price()->save(factory(Price::class)->make());
		/** @var User $user */
		$user = factory(User::class)->create();
		$this->be($user);

		$this->assertIsFloat($event->price->amount);

		$cart = new Cart();
		$cart->add($event);

		$cart->basket()->first()->price();
	}

	/** @test */
	public function get_total_value()
	{
		/** @var Event $event */
		$event = factory(Event::class)->create();
		/** @var Price $event_price */
		$event_price = factory(Price::class)->make();
		$event->price()->save($event_price);

		/** @var Resource $resource */
		$resource = factory(Resource::class)->create();
		/** @var Price $resource_price */
		$resource_price = factory(Price::class)->make();
		$resource->price()->save($resource_price);

		/** @var User $user */
		$user = factory(User::class)->create();
		$this->be($user);

		$cart = new Cart();
		$cart->add([
			['item' => $event, 'quantity' => 3],
			['item' => $resource, 'quantity' => 4]
		]);

		$this->assertIsFloat($cart->getTotalAttribute());
		$expected = 3 * $event_price->amount + 4 * $resource_price->amount;
		$this->assertEquals($expected, $cart->getTotalAttribute());
	}

	/** @test */
	public function get_count()
	{
		/** @var Event $event */
		$event = factory(Event::class)->create();

		/** @var Resource $resource */
		$resource = factory(Resource::class)->create();

		/** @var User $user */
		$user = factory(User::class)->create();
		$this->be($user);

		$cart = new Cart();
		$cart->add([
			['item' => $event, 'quantity' => 9],
			['item' => $resource, 'quantity' => 11]
		]);

		$this->assertEquals($cart->numberOfItems(), 20);
	}

	/** @test */
	public function get_total_tax()
	{
		/** @var Event $event */
		$event = factory(Event::class)->create();
		/** @var Price $event_price */
		$event_price = factory(Price::class)->make();
		$event->price()->save($event_price);

		/** @var Resource $resource */
		$resource = factory(Resource::class)->create();
		/** @var Price $resource_price */
		$resource_price = factory(Price::class)->make();
		$resource->price()->save($resource_price);

		/** @var User $user */
		$user = factory(User::class)->create();
		$this->be($user);

		$cart = new Cart();
		$event_quantity = 9;
		$resource_quantity = 11;
		$cart->add([
			['item' => $event, 'quantity' => $event_quantity],
			['item' => $resource, 'quantity' => $resource_quantity]
		]);

		$this->assertIsFloat($cart->tax());

		$total_should_be = round($event_quantity * $event_price->amount * $event_price->tax_rate, 2) +
			round($resource_quantity * $resource_price->amount * $resource_price->tax_rate, 2);

		$this->assertEquals($total_should_be, $cart->tax());
	}

	/** @test */
	public function delete_cart()
	{
		/** @var Event $event */
		$event = factory(Event::class)->create();

		/** @var Resource $resource */
		$resource = factory(Resource::class)->create();

		/** @var User $user */
		$user = factory(User::class)->create();
		$this->be($user);

		$cart = new Cart();
		$cart->add([
			['item' => $event, 'quantity' => 9],
			['item' => $resource, 'quantity' => 11],
		]);

		$this->assertDatabaseHas('cart_items', [
			'cart_id' => $cart->id,
			'item_type' => Event::class,
			'item_id' => $event->id,
			'quantity' => 9
		]);

		$cart->delete();

		$this->assertDatabaseMissing('cart_items', [
			'cart_id' => $cart->id,
			'item_type' => Event::class,
			'item_id' => $event->id
		]);

		$this->assertDatabaseMissing('cart_items', [
			'cart_id' => $cart->id,
			'item_type' => Resource::class,
			'item_id' => $resource->id
		]);
	}

	/** @test */
	public function retrieve_more_items_from_basket()
	{
		/** @var Cart $cart */
		$cart = new Cart();
		collect($classes = [
			Resource::class,
			Resource::class,
			Event::class,
			Resource::class,
			Event::class,
		])->each(function ($class) use (&$cart) {
			/** @var Sellable $model */
			$model = factory($class)->create();
			$cart->add($model, $quantity = rand(1, 7));

			$this->assertDatabaseHas('cart_items', [
				'cart_id' => $cart->id,
				'item_type' => $class,
				'item_id' => $model->id,
				'quantity' => $quantity
			]);
		});

		$this->assertEquals(count($classes),$cart->basket()->count());
	}

	/** @test */
	public function adding_an_additional_of_same_item_adds_quantity()
	{
		$resource = factory(Resource::class)->create();
		$cart = new Cart();
		$cart->add($resource, 4);
		$cart->add($resource, 14);

		$this->assertEquals($cart->items()->count(), 1, 'An identical item is added twice, but it should only be the quantity sum\'ed');
		$this->assertEquals($cart->numberOfItems(), 18, 'The item quantities where not summed.');
	}

	/** @test */
	public function get_the_currency()
	{
		/** @var Cart $cart */
		$cart = new Cart();
		collect($classes = [
			Resource::class,
			Resource::class,
			Event::class,
			Resource::class,
			Event::class,
		])->each(function ($class) use (&$cart) {
			/** @var Sellable $model */
			$model = factory($class)->create();
			/** @var Price $price */
			$price = factory(Price::class)->make();
			dump($price->currency);
			$model->price()->save($price);

			$cart->add($model, $quantity = rand(1, 7));

			$this->assertDatabaseHas('cart_items', [
				'cart_id' => $cart->id,
				'item_type' => $class,
				'item_id' => $model->id,
				'quantity' => $quantity
			]);

			$this->assertDatabaseHas('prices', [
				'priceable_type' => $class,
				'priceable_id' => $model->id
			]);
		});

		$response = $cart->getCurrencies();
		dd($response);
	}
}
