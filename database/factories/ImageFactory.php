<?php

use App\Models\Image;
use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

/** @var Factory $factory */
$factory->define(Image::class, function (Faker $faker) {
	$path = 'public/images';
	$file = Arr::random(Storage::files($path));
	return [
		'owner_id' => factory(User::class)->create(),
		'file'     => str_replace($path, '/storage/images', $file)
	];
});
