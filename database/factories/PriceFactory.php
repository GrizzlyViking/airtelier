<?php


use App\Models\Countries;
use App\Models\Price;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

/** @var Factory $factory */
$factory->define(Price::class, function (Faker $faker) {
	return [
		'amount'   => $faker->randomFloat(2, 0, 300),
		'tax_rate' => 0.25,
		'unit_size' => rand(1,10),
		'unit_type' => $faker->randomElement(
			[null, 'hour', 'day', 'week', 'month', 'year', 'kg', 'pounds']
		),
		'currency_code' => $faker->randomElement(
			['DKK', 'DKK', 'DKK', 'SEK', 'GBP', 'USD']
		)
	];
});
