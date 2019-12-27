<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Address
 *
 * @package App\Models
 *
 * @property integer    $id
 * @property string     $name
 * @property string     $address
 * @property string     $post_code
 * @property string     $town
 * @property Countries  $country
 * @property array      $geo_location
 * @property array      $meta
 *
 * @property Collection $users
 * @property Collection $events
 * @property Collection $resources
 */
class Address extends Model
{
	protected $fillable = [
		'name',
		'address',
		'post_code',
		'town',
		'country_code',
		'geo_location',
		'meta',
	];

	protected $casts = [
		'geo_location' => 'array',
		'meta'         => 'array',
	];

	protected $hidden = [
		'created_at',
		'updated_at',
	];

	protected $with = [
		'country'
	];

	public function users()
	{
		return $this->morphedByMany(User::class, 'addressables');
	}

	public function country()
	{
		return $this->belongsTo(Countries::class, 'country_code', 'country_code');
	}

	public function resources()
	{
		return $this->morphedByMany(Resource::class, 'addressables');
	}
}
