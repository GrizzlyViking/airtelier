<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Offer
 *
 * @package App\Models
 *
 * @property integer   $id
 * @property integer   $owner_id
 * @property string    $name
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
    protected $casts = [
        'meta' => 'array'
    ];

    protected $hidden = [
        'type_id',
        'address_id',
        'owner_id',
        'deleted_at',
        'updated_at',
        'owner',
    ];

    protected $appends = [
        'creator',
        'type'
    ];

    public function getCreatorAttribute()
    {
        return $this->owner->name;
    }

    public function getTypeAttribute()
    {
        return $this->offerType->type;
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }

    public function offerType(): BelongsTo
    {
        return $this->belongsTo(OfferType::class);
    }
}
