<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class Event
 *
 * @package App\Models
 *
 * @property int        $id
 * @property string     $slug
 * @property string     $title
 * @property string     $sub_title
 * @property array      $frequency
 * @property string     $owner_id
 * @property string     $description
 * @property array      $meta
 * @property Carbon     $start
 * @property Carbon     $end
 * @property User       $owner
 * @property Carbon     $created_at
 * @property Carbon     $updated_at
 *
 * @method static Builder relevant()
 * @method static Builder active()
 */
class Event extends Resourcable
{
	protected $casts = [
		'meta'      => 'array',
		'frequency' => 'array',
	];

	protected $dates = [
		'start',
		'end',
	];

	protected $fillable = [
		'owner_id',
		'title',
		'sub_title',
		'description',
		'frequency',
		'meta',
	];

	/**
	 * Get the route key for the model.
	 *
	 * @return string
	 */
	public function getRouteKeyName(): string
	{
		return 'slug';
	}

	public function articles()
	{
		return $this->morphToMany(
			Article::class,
			'element',
			'elements'
		);
	}

	public function scopeRelevant(Builder $query)
	{
		return $query->where('end', '>', now()->subYear());
	}

	public function scopeActive(Builder $query)
	{
		$query
			->whereNull('end')
			->orWhere('end', '>', now());
	}

	public function availability()
	{
		return $this->morphMany(
			Schedule::class,
			'item'
		);
	}
}
