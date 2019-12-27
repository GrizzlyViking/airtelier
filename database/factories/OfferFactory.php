<?php


use App\Models\Resource;
use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Arr;

/* @var $factory Factory */
$factory->define(Resource::class, function (Faker $faker) {
	return [
		'title'       => implode(' ', $faker->words),
		'sub_title'   => $faker->text(40),
		'slug'        => $faker->slug,
		'description' => '<p>'.implode('</p><p>', $faker->paragraphs(4)).'</p>',
		'meta'        => [
			$faker->word => $faker->text
		],
		'type_id'     => Arr::random([1, 2, 3]),
		'owner_id'    => factory(User::class)->create()
	];
});
