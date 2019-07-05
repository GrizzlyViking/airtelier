<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Offer,
    App\Models\Address;
use Faker\Generator as Faker;
use Illuminate\Support\Arr;

$factory->define(Offer::class, function (Faker $faker) {

    return [
        'name' => $faker->company,
        'description' => $faker->text(),
        'meta' => [
            $faker->word => $faker->text
        ],
        'address_id' => factory(Address::class)->create()->id,
        'type_id' => Arr::random([1,2,3])
    ];
});
