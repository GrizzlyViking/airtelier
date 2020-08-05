<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Price
 *
 * @package App\Models
 * @property int      $id
 * @property float    $amount
 * @property float    $tax_rate
 * @property int      $price_id
 * @property string   $unit_size
 * @property string   $unit_type
 * @property string   $currency_code
 * @property string   $description
 * @property string   $priceable_type
 * @property int      $priceable_id
 * @property float    $tax
 *
 * @property Resource $resource
 * @property Event    $event
 * @property Currency $currency
 */
class Price extends Model
{
	protected $fillable = [
		'amount',
		'unit_size',
		'tax_rate',
		'price_id',
		'currency_code',
		'description',
		'priceable_type',
		'priceable_id',
	];

	protected $hidden = [
		'created_at',
		'updated_at',
	];

	protected $casts = [
		'amount' => 'float'
	];

	protected $attributes = [
		'tax_rate'      => 0.25,
		'currency_code' => 'DKK',
		'country'       => 'DK'
	];

	public function resource()
	{
		return $this->morphTo(Resource::class);
	}

	public function event()
	{
		return $this->morphTo(Event::class);
	}

	public function getTaxAttribute()
	{
		return $this->tax();
	}

	public function tax()
	{
		return $this->amount * $this->tax_rate;
	}

	public function currency()
	{
		return $this->belongsTo(
			Currency::class,
			'currency_code',
			'code'
		);
	}

	public function convertTo(Currency $currency)
	{
		if ($this->currency->code === $currency->code) {
			return $this->amount;
		}

		return round($this->amount * ($currency->exchange_rate / $this->currency->exchange_rate), 2);
	}
}
