<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

/**
 * Class Countries
 *
 * @package App\Models
 * @property string $name
 * @property string $country_code
 * @property string $dial_code
 * @property string $currency_code
 * @property float  $exchange_rate
 * @property Currency $currency
 *
 * @method static insert(array $countries)
 **/
class Countries extends Model
{
	public $timestamps = false;

	protected $fillable = [
		'exchange_rate',
		'name',
		"country_code",
		"dial_code",
		"currency_code",
	];

	public function currency(): Relation
	{
		return $this->belongsTo(
			Currency::class,
			'code',
			'currency_code'
		);
	}
}
