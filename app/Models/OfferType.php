<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

/**
 * Class OfferType
 *
 * @package App\Models
 *
 * @property int $id
 * @property string $type
 * @property Collection $offers
 */
class OfferType extends Model
{
    public $timestamps = false;

    protected $table = 'offer_types';

    protected $fillable = ['type'];

    public function getRouteKeyName()
	{
		return 'type';
	}

	public function offers(): Relation
    {
        return $this->hasMany(
        	Offer::class,
			'type_id'
		);
    }
}
