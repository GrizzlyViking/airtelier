<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

/**
 * Class Offer
 *
 * @package App\Models
 *
 * @property integer   $id
 * @property integer   $owner_id
 * @property string    $title
 * @property string    $sub_title
 * @property integer   $address_id
 * @property string    $description
 * @property array     $meta
 * @property Address   $address
 * @property User      $owner
 * @property Carbon    $created_at
 * @property Carbon    $updated_at
 * @property OfferType $type
 */
class Offer extends Model
{
    protected $with = ['address'];

    protected $casts = [
        'meta' => 'array',
        'geo_location',
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
    ];

    protected $hidden = [
        'address_id',
        'deleted_at',
        'updated_at',
    ];

    protected $appends = [
        'creator',
        'type',
    ];

    public function getCreatorAttribute(): string
    {
        return $this->owner->name;
    }

    public function owner(): Relation
    {
        return $this->belongsTo(User::class);
    }

    public function address(): Relation
    {
        return $this->belongsTo(Address::class);
    }

    public function offerType(): Relation
    {
        return $this->belongsTo(OfferType::class, 'type_id');
    }

    public function getTypeAttribute(): string
    {
        if (!$this->offerType()->first() instanceof OfferType) {
            return 'unknown';
        }
        return $this->offerType()->first()->type;
    }
}
