<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Stripe\Collection;

/**
 * Class Currency
 *
 * @package App\Models
 * @property string $code
 * @property string $name
 * @property string $symbol
 * @property float  $exchange_rate
 *
 * @property Collection $countries
 * @property Collection $prices
 *
 * @method static insert(array $currencies)
 */
class Currency extends Model
{
	protected $primaryKey = 'code';
	public $incrementing = false;
	protected $fillable = [
		'code',
		'name',
		'symbol',
		'exchange_rate',
	];
	protected $visible = [
		'code',
		'name',
		'symbol',
		'exchange_rate',
	];
	protected $casts = [
		'exchange_rate' => 'float',
	];
	protected $attributes = [
		'currency_code' => 'DKK'
	];

	public function countries()
	{
		return $this->hasMany(
			Countries::class,
			'country_code',
			'code'
		);
	}

	public function prices()
	{
		return $this->hasMany(Price::class, 'currency_code', 'code');
	}
}
