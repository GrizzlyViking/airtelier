<?php

namespace Tests\Unit;

use App\Models\Cart;
use App\Models\Event;
use App\Models\Message;
use App\Models\Offer;
use App\Models\Price;
use App\Models\Review;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CartTest extends TestCase
{
	use RefreshDatabase;

    /**
     * A basic unit test example.
     * @test
     * @return void
     */
    public function add_offer_to_cart()
    {
    	$offer = factory(Offer::class)->create();
    	$user = factory(User::class)->create();
    	$this->be($user);

    	$cart = new Cart();
    	$cart->add($offer);

    	$this->assertDatabaseHas('cart_items', [
    		'item_type' => Offer::class,
			'item_id' => $offer->id
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
		$event = factory(Event::class)->create();
		$user = factory(User::class)->create();
		$this->be($user);

		$cart = new Cart();
		$cart->add($event, 3);

		$this->assertEquals($event->toArray(), $cart->basket()->first()->toArray());
	}

	/** @test */
	public function add_two_different_items_cart()
	{
		/** @var Event $event */
		$event = factory(Event::class)->create();
		/** @var Offer $offer */
		$offer = factory(Offer::class)->create();
		/** @var User $user */
		$user = factory(User::class)->create();
		$this->be($user);

		$cart = new Cart();
		$cart->add([
			['item' => $event, 'quantity' => 3],
			['item' => $offer, 'quantity' => 4]
		]);

		$this->assertDatabaseHas('cart_items', [
			'cart_id' => $cart->id,
			'item_type' => Event::class,
			'item_id' => $event->id,
			'quantity' => 3
		]);

		$this->assertDatabaseHas('cart_items', [
			'cart_id' => $cart->id,
			'item_type' => Offer::class,
			'item_id' => $offer->id,
			'quantity' => 4
		]);
	}

	/** @test */
	public function should_add_only_valid_items()
	{
		/** @var Event $event */
		$event = factory(Event::class)->create();
		/** @var Offer $offer */
		$offer = factory(Offer::class)->create();
		/** @var Message $message */
		$message = factory(Message::class)->create();
		/** @var User $user */
		$user = factory(User::class)->create();
		$this->be($user);

		$cart = new Cart();

		$cart->add([
			['item' => $event, 'quantity' => 3],
			['item' => $message, 'quantity' => 4],
			['item' => $offer, 'quantity' => 'not integer']
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
			'item_type' => Offer::class,
			'item_id' => $offer->id,
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

		/** @var Offer $offer */
		$offer = factory(Offer::class)->create();
		/** @var Price $offer_price */
		$offer_price = factory(Price::class)->make();
		$offer->price()->save($offer_price);

		/** @var User $user */
		$user = factory(User::class)->create();
		$this->be($user);

		$cart = new Cart();
		$cart->add([
			['item' => $event, 'quantity' => 3],
			['item' => $offer, 'quantity' => 4]
		]);

		$this->assertIsFloat($cart->total());
		$expected = 3 * $event_price->amount + 4 * $offer_price->amount;
		$this->assertEquals($expected, $cart->total());
	}

	/** @test */
	public function get_count()
	{
		/** @var Event $event */
		$event = factory(Event::class)->create();

		/** @var Offer $offer */
		$offer = factory(Offer::class)->create();

		/** @var User $user */
		$user = factory(User::class)->create();
		$this->be($user);

		$cart = new Cart();
		$cart->add([
			['item' => $event, 'quantity' => 9],
			['item' => $offer, 'quantity' => 11]
		]);

		$this->assertEquals($cart->count(), 20);
	}

	/** @test */
	public function get_total_tax()
	{
		/** @var Event $event */
		$event = factory(Event::class)->create();
		/** @var Price $event_price */
		$event_price = factory(Price::class)->make();
		$event->price()->save($event_price);

		/** @var Offer $offer */
		$offer = factory(Offer::class)->create();
		/** @var Price $offer_price */
		$offer_price = factory(Price::class)->make();
		$offer->price()->save($offer_price);

		/** @var User $user */
		$user = factory(User::class)->create();
		$this->be($user);

		$cart = new Cart();
		$event_quantity = 9;
		$offer_quantity = 11;
		$cart->add([
			['item' => $event, 'quantity' => $event_quantity],
			['item' => $offer, 'quantity' => $offer_quantity]
		]);

		$this->assertIsFloat($cart->tax());

		$total_should_be = round($event_quantity * $event_price->amount * $event_price->tax_rate, 2) +
			round($offer_quantity * $offer_price->amount * $offer_price->tax_rate, 2);

		$this->assertEquals($total_should_be, $cart->tax());
	}

	/** @test */
	public function delete_cart()
	{
		/** @var Event $event */
		$event = factory(Event::class)->create();

		/** @var Offer $offer */
		$offer = factory(Offer::class)->create();

		/** @var User $user */
		$user = factory(User::class)->create();
		$this->be($user);

		$cart = new Cart();
		$cart->add([
			['item' => $event, 'quantity' => 9],
			['item' => $offer, 'quantity' => 11],
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
			'item_type' => Offer::class,
			'item_id' => $offer->id
		]);
	}
}
