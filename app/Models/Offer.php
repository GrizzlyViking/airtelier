<?php

namespace App\Models;

use App\Traits\SlugTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\Relation;

/**
 * Class Offer
 *
 * @package App\Models
 *
 * @property integer    $id
 * @property string     $slug
 * @property integer    $owner_id
 * @property integer    $type_id
 * @property string     $title
 * @property string     $sub_title
 * @property string     $description
 * @property array      $meta
 * @property User       $owner
 * @property Carbon     $created_at
 * @property Carbon     $updated_at
 *
 * @property OfferType  $offerType
 */
class Offer extends Resourcable
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
	];

	public function getRouteKeyName()
	{
		return 'slug';
	}

	public function getCreatorAttribute(): string
	{
		return $this->owner->name;
	}

	public function offerType(): Relation
	{
		return $this->belongsTo(OfferType::class, 'type_id');
	}

	public function getTypeAttribute(): string
	{
		return $this->offerType->type;
	}

	public function articles()
	{
		return $this->morphToMany(
			Article::class,
			'element',
			'elements'
		);
	}
}
