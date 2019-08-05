<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

/**
 * Class User
 * @package App\Models
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $phone
 * @property Address $address
 * @property Offer[] $offers
 * @property integer $access_level
 * @property Carbon $updated_at
 * @property Carbon $created_at
 */
class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /** @var int */
    const ADMIN_LEVEL = 1;
    /** @var int */
    const USER_LEVEL = 3;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function offers(): HasMany
    {
        return $this->hasMany(Offer::class, 'owner_id');
    }

    /**
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->access_level >= self::ADMIN_LEVEL;
    }
}
