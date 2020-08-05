<?php

namespace App\Models;

use App\Events\RequestEvent;
use App\Traits\SlugTrait;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\Relation;

/**
 * Class Resource
 *
 * @package App\Models
 *
 * @property integer $id
 * @property string $slug
 * @property integer $owner_id
 * @property integer $type_id
 * @property string $title
 * @property string $sub_title
 * @property string $description
 * @property array $meta
 * @property User $owner
 * @property Carbon $created_at
 * @property Carbon $updated_at
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

	public function isAvailable(Carbon $from, Carbon $till): ?Schedule
	{
		return $this->availability->first(function (Schedule $event) use ($till, $from) {
			return ($event->status === 'available') && $event->starts_at <= $from && $till <= $event->ends_at;
		});
	}

	public function fetchAvailable(string $date = 'now'): Collection
	{
		return $this->availability()->fetchOnDay($date);
	}

	/**
	 * @param string $title
	 * @param string $description
	 * @param Carbon $from
	 * @param Carbon $till
	 * @param int $quantity
	 *
	 * @return bool
	 * @throws Exception
	 */
	public function generateAvailability(string $title, Carbon $from, Carbon $till, string $description = '', int $quantity = 1): bool
	{
		if (!$this->price) {
			throw new Exception('unable to generate availability for ' . $this->slug . ' because it doesn\'t have a price.');
		}

		while ($from < $till) {
			$this->availability()->createMany(Collection::times($quantity, function () use ($description, $title, $from) {
				return [
					'name'      => $title,
					'user_id'   => $this->owner_id,
					'starts_at' => $from,
					'ends_at'   => (clone $from)->add($this->makeDateTimeInterval($this->price->unit_size, $this->price->unit_type)),
					'status'    => self::AVAILABLE,
					'summary'   => $description,
				];
			}));
			$from->add($this->makeDateTimeInterval($this->price->unit_size, $this->price->unit_size));
		}

		return true;
	}

	private function makeDateTimeInterval(int $amount, string $human): CarbonInterval
	{
		switch ($human) {
			default:
			case 'hour':
			case 'hours':
				return CarbonInterval::make($amount . 'h');
			case 'minute':
			case 'minutes':
				return CarbonInterval::make($amount . 'm');
			case 'week':
			case 'weeks':
				return CarbonInterval::make($amount . 'w');
			case 'day':
			case 'days':
				return CarbonInterval::make($amount . 'd');
			case 'year':
			case 'years':
				return CarbonInterval::make($amount . 'y');

		}
	}

	/**
	 * Should this go to a controller instead?
	 *
	 * @param string $from
	 * @param string $till
	 *
	 * @return bool
	 */
	public function requestABooking(string $from, ?string $till): bool
	{
		$from = Carbon::parse($from);
		if (!($till = Carbon::parse($till))) {
			$till = (clone $from)->add($this->makeDateTimeInterval($this->price->unit_size, $this->price->unit_type));
		}

		/** @var Schedule $available */
		if ($available = $this->isAvailable($from, $till)) {
			event(new RequestEvent($available));

			return true;
		}

		return false;
	}
}
