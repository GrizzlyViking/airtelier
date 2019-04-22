<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * Class Resource
 * @package App\Models
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $address
 * @property array $meta
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 */
class Resource extends Model
{
    protected $casts = [
        'meta' => 'array'
    ];

    protected $fillable = [
        'name',
        'description',
        'address',
        'meta',
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
