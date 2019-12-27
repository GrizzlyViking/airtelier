<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartItemRequest as Request;
use App\Models\Cart;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
	public function add(Request $request): Response
	{
		$cart = $this->getCart();
		$cart->add($request->get('item'), $request->get('quantity', 1));
		session()->put('cart', $cart);
		return response($cart->basket());
	}

	public function get(): Response
	{
		$cart = $this->getCart();
		$cart->load('items');
		return response($cart->basket());
	}

	/**
	 * This fetches the cart, if available from session, otherwise creates a
	 * new one. If User id has become available, it is added.
	 *
	 * @return Cart
	 */
	protected function getCart(): Cart
	{
		/** @var Cart $cart */
		if (session()->has('cart')) {
			$cart = session()->get('cart');
			if (!Auth::guest() && !$cart->user_id) {
				$cart->update(['user_id' => Auth::user()->id]);
			}
			return $cart;
		} else {
			if (!Auth::guest()) {
				return Cart::firstOrCreate(['user_id' => Auth::user()->id]);
			} else {
				return Cart::create();
			}
		}
	}
}
