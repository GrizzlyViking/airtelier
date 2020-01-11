<?php

namespace App\Interfaces;

use App\Models\Cart;
use App\Models\Currency;
use App\Models\Price;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Relations\Relation;

/**
 * Interface Sellable
 *
 * @package App\Interfaces
 * @property Cart        $cart
 * @property Transaction $transactions
 * @property int         $quantity
 * @property Price		 $price
 */
interface Sellable
{
	public function cart(): Relation;

	public function transactions(): Relation;

	public function price(): Relation;
}
