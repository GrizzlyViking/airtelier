<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Cashier\Billable;
use Laravel\Passport\HasApiTokens;
use Stripe\Exception\ApiErrorException;
use Stripe\PaymentIntent;

/**
 * Class User
 *
 * @package App\Models
 *
 * @property integer    $id
 * @property string     $name
 * @property string     $email
 * @property string     $password
 * @property string     $phone
 * @property integer    $access_level
 * @property Carbon     $updated_at
 * @property Carbon     $created_at
 *
 * @property Collection $addresses
 * @property Collection $resources
 * @property Collection $events
 * @property Cart $cart
 */
class User extends Authenticatable
{
	use Notifiable, HasApiTokens, Billable;

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
		'name',
		'email',
		'password',
		'phone',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password',
		'remember_token',
	];

	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'email_verified_at' => 'datetime',
	];

	public function addresses(): Relation
	{
		return $this->morphToMany(
			Address::class,
			'addressable',
			'addressables'
		);
	}

	public function resources(): HasMany
	{
		return $this->hasMany(Resource::class, 'owner_id');
	}

	public function events(): Relation
	{
		return $this->hasMany(Event::class, 'owner_id');
	}

	/**
	 * @return bool
	 */
	public function isAdmin(): bool
	{
		return $this->access_level >= self::ADMIN_LEVEL;
	}

	public function cart(): Relation
	{
		return $this->hasMany(Cart::class);
	}

	/**
	 * @param array $options
	 *
	 * @return PaymentIntent
	 * @throws ApiErrorException
	 */
	public function createPaymentIntent(array $options = [])
	{
		return PaymentIntent::create(
			$options, $this->stripeOptions()
		);
	}

	public function role(): string
	{
		switch ($this->access_level) {
			case 1:
				return 'Admin';
			case 3:
				if (
					$this->resources->isNotEmpty() ||
					$this->events->isNotEmpty()
				) {
					return 'Contributor';
				}

				return 'Member';
		}
	}
}
