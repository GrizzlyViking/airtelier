<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartItemRequest as Request;
use App\Models\Cart;

class CartController extends Controller
{
	public function add(Request $request)
	{
		/** @var Cart $cart */
		$cart = $request->session()->get('cart', new Cart());
		$cart->add($request->get('item'), $request->get('quantity', 1));
		$request->session()->put('cart', $cart);
		return response($cart->basket());
	}

	public function get()
	{
		/** @var Cart $cart */
		$cart = session()->get('cart');
		$cart->load('items');
		return response($cart->basket());
	}
}
