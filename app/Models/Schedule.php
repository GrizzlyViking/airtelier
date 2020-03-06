<?php

namespace App\Models;

use App\Interfaces\Sellable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Schedule
 *
 * @package App\Models
 * @property int      $id
 * @property string   $name
 * @property int      $user_id
 * @property int      $schedulable_id
 * @property string   $schedulable_type
 * @property Carbon   $starts_at
 * @property Carbon   $ends_at
 * @property string   $status
 * @property string   $summary
 * @property string   $uid
 * @property Carbon   $create_at
 * @property Carbon   $updated_at
 * @property Carbon   $deleted_at
 *
 * @property User     $owner
 * @property Sellable $schedulable
 */
class Schedule extends Model
{
	use SoftDeletes;

	protected $dates = [
		'starts_at',
		'ends_at',
	];

	protected $fillable = [
		'name',
		'user_id',
		'schedulable_id',
		'schedulable_type',
		'starts_at',
		'ends_at',
		'status',
		'summary',
		'uid',
	];

	public function generateUniqueID(): string
	{
		return now()->format('YmdHisu');
	}

	public function owner(): Relation
	{
		return $this->belongsTo(User::class);
	}

	public function schedulable()
	{
		return $this->morphTo();
	}
}
