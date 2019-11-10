<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Review;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(Review::class, function (Faker $faker) {
    return [
        'author_id' => factory(User::class)->create(),
        'rating' => $faker->randomFloat(2, 0, 5),
        'description' => $faker->text
    ];
});
