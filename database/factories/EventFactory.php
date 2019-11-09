<?php


use App\Models\Event;
use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

/* @var $factory Factory */
$factory->define(Event::class, function (Faker $faker) {
	return [
		'owner_id'    => factory(User::class)->create(),
		'title'       => $faker->text(40),
		'sub_title'   => $faker->text(200),
		'description' => implode(' ', $faker->paragraphs(3)),
		'frequency'   => ['monthly' => '5th'],
		'meta'        => ['age group' => '40 to 50 year old transgender hamsters']
	];
});
