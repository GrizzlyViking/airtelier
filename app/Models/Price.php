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

	public function offer()
	{
		return $this->morphTo(Offer::class);
    }

	public function event()
	{
		return $this->morphTo(Event::class);
    }

	public function getTaxAttribute()
	{
		return $this->amount * $this->tax_rate;
    }
}
