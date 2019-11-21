<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Countries
 *
 * @package App\Models
 * @property string $name
 * @property string $country_code
 * @property string $dial_code
 * @property string $currency_name
 * @property string $currency_symbol
 * @property string $currency_code
 * @property float  $exchange_rate
 **/
class Countries extends Model
{
	public $timestamps = false;
	protected $fillable = [
		'exchange_rate',
		'name',
		"country_code",
		"dial_code",
		"currency_name",
		"currency_symbol",
		"currency_code",
	];
}
