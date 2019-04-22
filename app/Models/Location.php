<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Location
 * @package App\Models
 *
 * @property int id
 * @property string name
 * @property string description
 * @property string address
 * @property array meta
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property Carbon deleted_at
 */
class Location extends Model
{
    use SoftDeletes;

    protected $casts = [
        'meta' => 'array'
    ];

    protected $fillable = [
        'name',
        'description',
        'address',
        'meta',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewed');
    }
}
