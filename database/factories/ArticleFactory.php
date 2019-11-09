<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Article;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(Article::class, function (Faker $faker) {
    return [
        'title' => implode(' ', $faker->words),
        'author_id' => factory(User::class)->create(),
        'sub_title' => $faker->text,
        'resume' => $faker->text,
        'content' => implode(PHP_EOL.PHP_EOL, $faker->paragraphs(5)),
        'publish' => $faker->dateTime,
        'un_publish' => $faker->dateTime
    ];
});
