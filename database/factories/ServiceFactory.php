<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Service;
use Faker\Generator as Faker;

$factory->define(Service::class, function (Faker $faker) {
    return [
        'name'        => $faker->name,
        'description' => $faker->text,
        'address'     => $faker->address,
        'postcode'    => $faker->postcode,
        'town'        => $faker->city,
        'meta'        => [
            $faker->longitude,
            $faker->latitude,
        ]
    ];
});
