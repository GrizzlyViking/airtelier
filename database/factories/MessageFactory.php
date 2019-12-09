<?php

use App\Models\Message;
use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

/* @var $factory Factory */
$factory->define(Message::class, function (Faker $faker) {
    return [
		'sender_id' => factory(User::class)->create(),
		'recipient_id' => factory(User::class)->create(),
		'subject' => $faker->sentence(6),
		'message' => $faker->text,
		'sent' => $faker->dateTime,
    ];
});
