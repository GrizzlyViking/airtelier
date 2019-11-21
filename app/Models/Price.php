<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Price
 *
 * @package App\Models
 * @property int $id
 * @property int $price_id
 * @property string $description
 * @property string $element_type
 * @property int $element_id
 */
class Price extends Model
{
	public function offer()
	{
		return $this->morphTo(Offer::class);
    }

	public function event()
	{
		return $this->morphTo(Event::class);
    }
}
