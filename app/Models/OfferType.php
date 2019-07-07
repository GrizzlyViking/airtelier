<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

/**
 * Class OfferType
 *
 * @package App\Models
 *
 * @property int $id
 * @property string $type
 */
class OfferType extends Model
{
    public $timestamps = false;

    protected $table = 'offer_types';

    protected $fillable = ['type'];

    public function offers(): Relation
    {
        return $this->belongsToMany(Offer::class);
    }
}
