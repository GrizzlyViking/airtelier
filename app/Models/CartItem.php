<?php

namespace App\Models;

use App\Interfaces\Sellable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * Class CartItem
 *
 * @package App\Models
 *
 * @property int $cart_id
 * @property int $item_id
 * @property string $item_type
 * @property int $quantity
 * @property Carbon $updated_at
 * @property Carbon $created_at
 * @property Sellable $item
 * @property Cart $cart
 * @property float $total
 */
class CartItem extends Model
{
	protected $appends = [
		'item',
		'total',
	];

	public function cart()
	{
		return $this->belongsTo(Cart::class);
    }

	public function items()
	{
		return $this->morphTo();
    }

	public function getItemAttribute(): Sellable
	{
		return app($this->item_type)->findOrFail($this->item_id);
    }

	public function unitPrice(): float
	{
		if ($this->item->price instanceof Price) {
			return $this->item->price->convertTo($this->cart->currency);
		}

		return 0.0;
	}

	public function getTotalAttribute(): float
	{
		return $this->total();
	}

	public function total(): float
	{
		if ($this->item->price instanceof Price) {
			return $this->item->price->convertTo($this->cart->currency) * $this->quantity;
		}

		return 0.0;
	}
}
