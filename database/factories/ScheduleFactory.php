<?php

use App\Models\Schedule;
use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Carbon;

/** @var Factory $factory */
$factory->define(Schedule::class, function (Faker $faker, $value) {
	return [
		'name'      => $faker->word,
		'user_id'   => User::all()->random()->id,
		/** \Illuminate\Support\Carbon $starts_at */
		'starts_at' => $starts_at = Carbon::parse($faker->dateTimeThisYear->format('Y-m-d H:00:00')),
		'ends_at'   => (clone $starts_at)->addHour(),
		'status'    => $faker->randomElement(['completed', 'requested', 'booked', 'cancelled', 'available']),
		'summary'   => $faker->text,
	];
});
