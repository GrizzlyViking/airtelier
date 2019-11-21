<?php


use App\Models\Transaction;
use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

/** @var Factory $factory */
$factory->define(Transaction::class, function (Faker $faker) {
	return [
		'user_id'       => factory(User::class)->create(),
		'amount'        => $faker->randomFloat(2, 0, 2000),
		'currency'      => $faker->currencyCode,
		'exchange_rate' => $faker->randomFloat(4, 0, 100),
		'created_at'    => $created = $faker->dateTimeThisMonth(),
		'updated_at'    => $created
	];
});
