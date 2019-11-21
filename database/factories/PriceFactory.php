<?php


use App\Models\Countries;
use App\Models\Price;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

/** @var Factory $factory */
$factory->define(Price::class, function (Faker $faker) {
	return [
		'amount'   => $faker->randomFloat(2, 0, 300),
		'currency' => $faker->randomElement(
			['DKK', 'SEK', 'GBP', 'USD']
		)
	];
});
