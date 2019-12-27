<?php

namespace App\Models;

use App\Interfaces\Sellable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

/**
 * Class Cart
 *
 * @package App\Models
 * @property int        $id
 * @property int        $user_id
 * @property array      $parameters
 * @property Carbon		$updated_at
 * @property Carbon		$created_at
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

	public function items(): Relation
	{
		return $this->hasMany(CartItem::class);
	}

	/**
	 * @return Collection|CartItem[]
	 */
	public function basket(): Collection
	{
		return $this->items()->get()->map(function (CartItem $item) {
			if (class_exists($item->item_type)) {
				/** @var Model $model */
				$model = app($item->item_type)->findOrFail($item->item_id);
				$model->setAttribute('quantity', $item->quantity);
				return $model;
			}

			return $item;
		});
	}

	public function resources()
	{
		return $this->morphedByMany(Resource::class, 'item', 'cart_items');
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
			$this->save();
		}

		if (!Auth::guest() && !$this->user_id) {
			$this->update(['user_id' => Auth::user()->id]);
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
			/** @var CartItem $found */
			if ($found = $this->items()->where('item_type',get_class($item))->where('item_id',$item->id)->first()) {
				$found->quantity += $quantity;
				$found->save();
				return;
			}
			switch (get_class($item)) {
				case Event::class:
					$this->events()->attach($item, ['quantity' => $quantity]);
					break;
				case Resource::class:
					$this->resources()->attach($item, ['quantity' => $quantity]);
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
		return $this->items()->get()->sum('quantity');
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
