<?php

namespace Tests\Unit;

use App\Models\Event;
use App\Models\Price;
use App\Models\Resource;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ScheduleTest extends TestCase
{
	use RefreshDatabase;

	/** @test */
	public function when_schedule_is_created_unique_id()
	{
		/** @var Resource $resource */
		$resource = factory(Resource::class)->create();
		$resource->availability()->save(factory(Schedule::class)->make());


		$this->assertIsString($resource->availability->first()->uid);
		$this->assertTrue(strlen($resource->availability->first()->uid) > 4);
    }

	/**
	 * @test
	 */
	public function add_schedule_to_a_resource()
	{
		/** @var Resource $resource */
		$resource = factory(Resource::class)->create();

		/** @var Schedule $event */
		$resource->availability()->save($event = factory(Schedule::class)->make());

		$this->assertDatabaseHas('schedules', [
			'schedulable_type' => $event->schedulable_type,
			'schedulable_id' => $event->schedulable_id,
		]);
	}

	/** @test */
	public function check_whether_a_resource_is_available_at_a_particular_time_range()
	{
		/** @var Resource $resource */
		$resource = factory(Resource::class)->create();

		$resource->availability()->save(
		/** @var Schedule $schedule */
			$schedule = factory(Schedule::class)->make([
				'starts_at' => $start_at = now(),
				'ends_at' => (clone $start_at)->addDays(5),
			])
		);

		$first_available = $resource->isAvailable((clone $start_at)->addHours(1), (clone $start_at)->addHours(5));

		// Period should be accepted
		$this->assertTrue($first_available instanceof Schedule);

		// Period should be refused
		$this->assertNull($resource->isAvailable((clone $start_at)->subHours(1), (clone $start_at)->addHours(5)));

		// Period should be refused
		$this->assertNull($resource->isAvailable((clone $start_at)->addHours(1), (clone $start_at)->addWeeks(15)));
	}

	/** @test
	 * @throws \Exception
	 */
	public function generate_availability_for_a_resource()
	{
		/** @var Resource $resource */
		$resource = factory(Resource::class)->create();
		$resource->price()->save(factory(Price::class)->make([
			'unit_size' => 'hour'
		]));
		$resource->generateAvailability('Dog walking', Carbon::parse('2020-05-29 08:00:00'), $end = Carbon::parse('2020-05-29 22:00:00'), 'Could be more than one dog walked at same time.', 3);

		/** @var Schedule $last */
		$last = $resource->availability()->get()->last();
		$this->assertTrue($last->ends_at->toDateString() === $end->toDateString(), 'The generated time buckets last generated endpoint doesnt match with requested.');
		$this->assertTrue($resource->availability->count() > 10, 'Resource should at least have 10 availability');
	}

	/**
	 * @test
	 * @throws \Exception
	 */
	public function fetch_available_time_buckets_for_a_day()
	{
		/** @var Resource $resource */
		$resource = factory(Resource::class)->create();
		$resource->price()->save(factory(Price::class)->make([
			'unit_size' => 'hour'
		]));
		$resource->generateAvailability('Dog walking', Carbon::parse('2020-05-29 08:00:00'), $end = Carbon::parse('2020-05-29 22:00:00'), 'Could be more than one dog walked at same time.', 3);

		$this->assertTrue($resource->fetchAvailable('2020-05-29')->isNotEmpty());
	}

	/** @test */
	public function book_a_time()
	{
		/** @var Resource $resource */
		$resource = factory(Resource::class)->create();
		$resource->price()->save(factory(Price::class)->make([
			'unit_size' => 'hour'
		]));
		$resource->generateAvailability('Dog walking', Carbon::parse('2020-05-29 08:00:00'), $end = Carbon::parse('2020-05-29 22:00:00'), 'Could be more than one dog walked at same time.', 3);

		$resource->requestABooking('2020-05-29 10:00:00');
	}
}
