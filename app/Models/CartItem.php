<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CartItem
 *
 * @package App\Models
 *
 * @property int $cart_id
 * @property int $item_id
 * @property string $item_type
 * @property int $quantity
 */
class CartItem extends Model
{
	public function cart()
	{
		return $this->belongsTo(Cart::class);
    }

	public function items()
	{
		return $this->morphTo();
    }
}
