<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Resource;
use Faker\Generator as Faker;

$factory->define(Resource::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->text,
        'address' => $faker->address,
        'town' => $faker->city,
        'postcode' => $faker->postcode,
        'meta' => [
            'lat' => $faker->latitude,
            'lon' => $faker->longitude,
        ],
    ];
});
