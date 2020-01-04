<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Price
 *
 * @package App\Models
 * @property int $id
 * @property float $amount
 * @property float $tax_rate
 * @property int $price_id
 * @property string $currency
 * @property string $description
 * @property string $element_type
 * @property int $element_id
 * @property float $tax
 */
class Price extends Model
{
	protected $casts = [
		'amount' => 'float'
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
		return $this->amount * $this->tax_rate;
    }

	public function currencyElement()
	{
		return $this;
    }
}
