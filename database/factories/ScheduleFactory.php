<?php

use App\Models\Event;
use App\Models\Resource;
use App\Models\Schedule;
use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

/** @var Factory $factory */
$factory->define(Schedule::class, function (Faker $faker) {
	$item_type = $faker->randomElement([
		Resource::class,
		Event::class,
		Resource::class,
		Resource::class,
	]);

	$item = factory($item_type)->create();
	return [
		'name'      => $faker->word,
		'user_id'   => factory(User::class)->create(),
		'item_id'   => $item->id,
		'item_type' => $item_type,
		/** \Illuminate\Support\Carbon $starts_at */
		'starts_at' => $starts_at = now(),
		'ends_at'   => (clone $starts_at)->addDays(rand(1,7))->addWeeks(rand(1,5)),
		'status'    => $faker->randomElement(['completed', 'requested', 'booked', 'cancelled']),
		'summary'   => $faker->text,
	];
});
