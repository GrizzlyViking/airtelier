<?php


use App\Models\Offer;
use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Arr;

/* @var $factory Factory */
$factory->define(Offer::class, function (Faker $faker) {
	return [
		'title'       => implode(' ', $faker->words),
		'slug'       => $faker->slug,
		'description' => $faker->text(),
		'meta'        => [
			$faker->word => $faker->text
		],
		'type_id'     => Arr::random([1, 2, 3]),
		'owner_id'    => factory(User::class)->create()
	];
});
