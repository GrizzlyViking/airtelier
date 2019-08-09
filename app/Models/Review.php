<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Review
 * @package App\Models
 *
 * @property int $id
 * @property int $author_id
 * @property Offer $reviewed
 * @property float $rating
 * @property string $description
 * @property Carbon $updated_at
 * @property Carbon $created_at
 * @property Carbon $deleted_at
 */
class Review extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'author_id',
        'reviewed_type',
        'reviewed_id',
        'rating',
        'description'
    ];

    protected $casts = [
        'rating' => 'float'
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function reviewed()
    {
        return $this->morphTo();
    }
}
