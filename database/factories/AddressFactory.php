<?php

use App\Models\Address;
use Faker\Generator as Faker,
    \Illuminate\Database\Eloquent\Factory;
/* @var $factory Factory */

$factory->define(Address::class, function (Faker $faker) {
    return [
        'name' => $faker->text(20),
        'address' => $faker->address,
        'post_code' => $faker->postcode,
        'town' => $faker->city,
        'country' => $faker->countryCode,
        'geo_location' => [
            'longitude' => $faker->longitude,
            'latitude' =>  $faker->latitude
        ],
        'meta' => [
            'phone' => $faker->phoneNumber
        ],
    ];
});
