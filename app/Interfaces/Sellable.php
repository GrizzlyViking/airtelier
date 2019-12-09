<?php

namespace App\Interfaces;

use App\Models\Cart;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Relations\Relation;

/**
 * Interface Sellable
 *
 * @package App\Models\_interfaces
 * @property Cart $cart
 * @property Transaction $transactions
 */
interface Sellable
{
	public function cart(): Relation;

	public function transactions(): Relation;

	public function price(): Relation;
}
