<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Location;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(Location::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'description' => $faker->text,
        'address' => $faker->address,
        'owner_id' => factory(User::class),
        'meta' => [
            'geo_location' => [
                'lat' => $faker->latitude,
                'lon' => $faker->longitude,
            ]
        ]
    ];
});
