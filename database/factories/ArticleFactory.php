<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Article;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(Article::class, function (Faker $faker) {
    return [
        'author_id' => factory(User::class),
        'title' => $faker->title,
        'sub_title' => $faker->title,
        'resume' => $faker->text,
        'content' => $faker->randomHtml(),
        'publish' => $faker->dateTime,
        'un_publish' => $faker->dateTime
    ];
});
