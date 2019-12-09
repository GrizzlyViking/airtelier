<?php

namespace App\Models;

use App\Interfaces\Sellable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

/**
 * Class Cart
 *
 * @package App\Models
 * @property int        $id
 * @property int        $user_id
 * @property array      $parameters
 *
 * @property User       $user
 * @property Collection $items
 *
 */
class Cart extends Model
{
	protected $fillable = [
		'user_id',
		'item_type',
		'item_id',
		'quantity',
	];

	protected $casts = [
		'parameters' => 'array'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function items()
	{
		return $this->hasMany(CartItem::class);
	}

	public function basket()
	{
		return $this->items->map(function (CartItem $item) {
			if (class_exists($item->item_type)) {
				/** @var Model $model */
				$model = app($item->item_type)->findOrFail($item->item_id);
				return $model->setAttribute('quantity', $item->quantity);
			}

			return $item;
		});
	}

	public function offers()
	{
		return $this->morphedByMany(Offer::class, 'item', 'cart_items');
	}

	public function events()
	{
		return $this->morphedByMany(Event::class, 'item', 'cart_items');
	}

	/**
	 * @param Sellable|array $item
	 * @param int            $quantity
	 */
	public function add($item, $quantity = 1): void
	{
		if (!$this->id) {
			if (!$this->user_id) {
				$this->user_id = Auth::user()->id;
			}
			$this->save();
		}

		if (is_array($item)) {
			foreach ($item as $value) {
				if (Arr::has($value, ['item', 'quantity'])) {
					$this->add($value['item'], $value['quantity'] ?? 1);
				}
			}
			return;
		}

		if (!is_int($quantity)) return;

		if ($item instanceof Sellable) {
			switch (get_class($item)) {
				case Event::class:
					$this->events()->attach($item, ['quantity' => $quantity]);
					break;
				case Offer::class:
					$this->offers()->attach($item, ['quantity' => $quantity]);
					break;
			}
		}
	}

	/**
	 * @return float
	 */
	public function total(): float
	{
		return $this->basket()->sum(function (Sellable $item) {
			return round($item->price->amount * $item->quantity, 2);
		});
	}

	/**
	 * @return int
	 */
	public function count(): int
	{
		return $this->items->sum('quantity');
	}

	/**
	 * @return float
	 */
	public function tax(): float
	{
		return $this->basket()->sum(function (Sellable $item) {
			return round($item->price->tax * $item->quantity, 2);
		});
	}
}
