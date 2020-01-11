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
 * @property string		$currency_code
 *
 * @property User       $user
 * @property Collection $items
 * @property Currency	$currency
 * @property Collection $basket
 */
class Cart extends Model
{
	protected $fillable = [
		'user_id',
		'item_type',
		'item_id',
		'quantity',
		'currency_code'
	];

	protected $casts = [
		'parameters' => 'array'
	];

	protected $appends = [
		'total',
		'count',
		'tax',
		'basket',
	];
	protected $attributes = [
		'currency_code' => 'DKK'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function items(): Relation
	{
		return $this->hasMany(CartItem::class);
	}

	public function currency(): Relation
	{
		return $this->belongsTo(
			Currency::class,
			'currency_code',
			'code'
		);
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
				if ($model->price instanceof Price) {
					$model->setAttribute('quantity', $item->quantity);
					$model->setAttribute('currency_code', $this->currency->code);
					$model->setAttribute('amount', $model->price->convertTo($this->currency));
				}
				return $model;
			}

			return $item;
		});
	}

	public function getBasketAttribute()
	{
		return $this->basket();
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
		return round($this->basket()->sum(function (Sellable $item) {
			if ($item->price instanceof Price) {
				return $item->price->convertTo($this->currency) * $item->quantity;
			}
			return 0;
		}), 2);
	}

	/**
	 * @return float
	 */
	public function getTotalAttribute(): float
	{
		return $this->total();
	}

	public function numberOfItems()
	{
		return $this->items()->get()->sum('quantity');
	}

	/**
	 * @return int
	 */
	public function getCountAttribute(): int
	{
		return $this->numberOfItems();
	}

	public function tax()
	{
		return round($this->basket()->sum(function (Sellable $item) {
			if ($item->price instanceof Price) {
				return
					$item->price->convertTo($this->currency) *
					$item->price->tax_rate *
					$item->quantity;
			}
			return 0;
		}), 2);
	}

	/**
	 * @return float
	 */
	public function getTaxAttribute(): float
	{
		return $this->tax();
	}

	public function getCurrencies()
	{
		return $this->basket()->map(function (Sellable $item) {
			return $item->price->currency;
		})->unique();
	}
}
