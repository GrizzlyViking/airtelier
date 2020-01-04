<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartItemRequest as Request;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Stripe\Exception\ApiErrorException;
use Stripe\SetupIntent;

class CartController extends Controller
{
	public function checkout()
	{
		$cart = $this->getCart();
		return view('frontend.checkout', compact('cart'));
	}

	/**
	 * @return Factory|View
	 * @throws ApiErrorException
	 */
	public function payment()
	{
		$cart = $this->getCart();
		/** @var User $user */
		$user = Auth::user();
		$intent = $user->createPaymentIntent([
			'amount' => $cart->getTotalAttribute() * 100,
			'currency' => 'dkk'
		]);

		return view('frontend.payment', compact('intent', 'cart', 'user'));
	}

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
		return response($cart);
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
