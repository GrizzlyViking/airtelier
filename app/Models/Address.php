<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Address
 *
 * @package App\Models
 *
 * @property string $name
 * @property string $address
 * @property string $post_code
 * @property string $town
 * @property string $country
 * @property array  $geo_location
 * @property array  $meta
 */
class Address extends Model
{
    protected $fillable = [
        'name',
        'address',
        'post_code',
        'town',
        'country',
        'geo_location',
        'meta',
    ];

    protected $casts = [
        'geo_location' => 'array',
        'meta'         => 'array',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $with = ['country'];

    public function country()
    {
        return $this->belongsTo(Countries::class, 'country_code', 'code');
    }
}
