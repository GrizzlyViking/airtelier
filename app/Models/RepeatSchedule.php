<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

/**
 * Class RepeatSchedule
 *
 * @package App\Models
 * @property string $description
 * @property int $user_id
 * @property User $owner
 * @property Collection $schedules
 */
class RepeatSchedule extends Model
{
    protected $table = 'repeating_schedules';

    protected $fillable = [
    	'description',
		'user_id'
	];

	public function owner(): Relation
	{
		return $this->belongsTo(User::class);
    }

	public function schedules(): Relation
	{
		return $this->hasMany(Schedule::class);
    }
}
