<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Countries
 *
 * @package App\Models
 * @property string $code
 * @property string $name
 */
class Countries extends Model
{
    public $timestamps = false;
    protected $fillable = ['code', 'name'];
}
