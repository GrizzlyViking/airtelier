<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

/**
 * Class ResourceType
 *
 * @package App\Models
 *
 * @property int $id
 * @property string $type
 * @property Collection $resources
 */
class ResourceType extends Model
{
    public $timestamps = false;

    protected $table = 'resource_types';

    protected $fillable = ['type'];

    public function getRouteKeyName()
	{
		return 'type';
	}

	public function resources(): Relation
    {
        return $this->hasMany(
        	Resource::class,
			'type_id'
		);
    }
}
