<?php

namespace App\Models;

use App\Traits\SlugTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\Relation;

/**
 * Class Resource
 *
 * @package App\Models
 *
 * @property integer    $id
 * @property string     $slug
 * @property integer      $owner_id
 * @property integer      $type_id
 * @property string       $title
 * @property string       $sub_title
 * @property string       $description
 * @property array        $meta
 * @property User         $owner
 * @property Carbon       $created_at
 * @property Carbon       $updated_at
 *
 * @property ResourceType $resourceType
 * @property Collection $availability
 */
class Resource extends Resourcable
{
	use SlugTrait;

	protected $with = ['addresses'];

	protected $casts = [
		'meta'         => 'array',
		'geo_location' => 'array',
	];

	protected $fillable = [
		'owner_id',
		'title',
		'sub_title',
		'address_id',
		'description',
		'geo_location',
		'meta',
		'type_id',
		'slug',
	];

	protected $hidden = [
		'deleted_at',
		'updated_at',
	];

	protected $appends = [
		'creator',
		'type',
		'component_type',
		'class',
	];

	public function getRouteKeyName()
	{
		return 'slug';
	}

	public function getCreatorAttribute(): string
	{
		return $this->owner->name;
	}

	public function resourceType(): Relation
	{
		return $this->belongsTo(ResourceType::class, 'type_id');
	}

	public function getTypeAttribute(): string
	{
		return $this->resourceType->type;
	}

	public function articles()
	{
		return $this->morphToMany(
			Article::class,
			'element',
			'elements'
		);
	}

	public function availability()
	{
		return $this->morphMany(
			Schedule::class,
			'schedulable'
		);
	}

	public function isAvailable(Schedule $purchasable_period): bool
	{
		return $this->availability->filter(function (Schedule $schedule) use ($purchasable_period) {
			return $purchasable_period->starts_at->between($schedule->starts_at, $schedule->ends_at) &&
				$purchasable_period->ends_at->isBefore($schedule->ends_at);
		})->count() > 0;
	}
}
