<?php


use App\Models\Event;
use App\Models\User;
use Carbon\Carbon;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

/* @var $factory Factory */
$factory->define(Event::class, function (Faker $faker) {
	$end = null;
	/** @var Carbon $start */
	if ($start = $faker->randomElement([
		Carbon::parse($faker->dateTimeThisCentury('now')),
		Carbon::parse($faker->dateTimeThisMonth('now')),
		Carbon::parse($faker->dateTimeThisYear('now'))
	])) {
		$end = clone $start;
		$end = $faker->randomElement([
			null,
			$end->addMonths(rand(1, 7)),
			$end->addYears(rand(1, 3))
		]);
	}
	return [
		'owner_id'    => factory(User::class)->create(),
		'slug'        => $faker->slug(),
		'title'       => $faker->text(40),
		'sub_title'   => $faker->text(200),
		'description' => '<p>' . implode('</p><p>', $faker->paragraphs(3)) . '</p>',
		'frequency'   => ['monthly' => '5th'],
		'meta'        => ['age group' => '40 to 50 year old transgender hamsters'],
		'start'       => $start,
		'end'         => $end
	];
});
