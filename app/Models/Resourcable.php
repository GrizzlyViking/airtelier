<?php


namespace App\Models;


use App\Models\_interfaces\ResourceInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

/**
 * Class Resourcable
 *
 * @package App\Models
 * @property User       $owner
 * @property Collection $addresses
 * @property Collection $reviews
 * @property Collection $gallery
 * @property Collection $prices
 * @property Collection $transactions
 */
class Resourcable extends Model implements ResourceInterface
{
	protected $appends = [
		'component_type',
	];
	public function addresses(): Relation
	{
		return $this->morphToMany(
			Address::class,
			'addressable',
			'addressables'
		)->withPivot('type');
	}

	public function reviews(): Relation
	{
		return $this->morphMany(
			Review::class,
			'reviewed'
		);
	}

	public function owner(): Relation
	{
		return $this->belongsTo(User::class, 'owner_id');
	}

	public function price(): Relation
	{
		return $this->morphOne(
			Price::class,
			'priceable'
		);
	}

	public function gallery(): Relation
	{
		return $this->morphToMany(
			Image::class,
			'relation',
			'gallery'
		)->withPivot('purpose');
	}

	public function transactions(): Relation
	{
		return $this->morphMany(
			Transaction::class,
			'paid_for'
		);
	}

	public function getComponentTypeAttribute(): string
	{
		return preg_replace('/^.*\\\(\w+)$/','$1',static::class);
	}
}
