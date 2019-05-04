<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Service
 * @package App\Models
 *
 * @property int $id
 * @property string $title
 * @property string $sub_title
 * @property string $resume
 * @property string $content
 * @property Carbon $publish
 * @property Carbon $un_publish
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 */
class Service extends Model
{
    use SoftDeletes;

    protected $dates = [
        'publish',
        'un_publish',
    ];

    protected $fillable = [
        'title',
        'sub_title',
        'resume',
        'content',
        'publish',
        'un_publish',
    ];

    protected $casts = [
        'meta' => 'array'
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
