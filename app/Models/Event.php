<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * Class Event
 * @package App\Models
 *
 * @property int $id
 * @property string $name
 * @property Carbon $start
 * @property Carbon $end
 */
class Event extends Model
{
    protected $dates = [
        'start',
        'end'
    ];

    protected $fillable = [
        'name',
        'start',
        'end',
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function reviews(): MorphMany
    {
        return $this->morphMany(Review::class, 'reviewed');
    }
}
