<?php

namespace Tests\Unit;

use App\Models\Event;
use App\Models\Resource;
use App\Models\Schedule;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ScheduleTest extends TestCase
{
	use RefreshDatabase;

	/** @test */
	public function when_schedule_is_created_unique_id()
	{
		/** @var Schedule $event */
		$event = factory(Schedule::class)->create();

		$this->assertIsString($event->uid);
		$this->assertTrue(strlen($event->uid) > 4);
    }

	/**
	 * @test
	 */
	public function add_schedule_to_a_resource()
	{
		/** @var Schedule $event */
		$event = factory(Schedule::class)->create();

		/** @var Resource $resource */
		$resource = factory(Resource::class)->create();

		$resource->availability()->save($event);

		$this->assertDatabaseHas('schedules', [
			'schedulable_type' => $event->schedulable_type,
			'schedulable_id' => $event->schedulable_id,
		]);
	}

	/** @test */
	public function add_a_schedule_to_an_event()
	{
		/** @var Schedule $schedule */
		$schedule = factory(Schedule::class)->create();

		/** @var Event $event */
		$event = factory(Resource::class)->create();

		$event->availability()->save($schedule);

		$this->assertDatabaseHas('schedules', [
			'schedulable_type' => $schedule->schedulable_type,
			'schedulable_id' => $schedule->schedulable_id,
		]);
	}

	/** @test */
	public function check_whether_a_resource_is_available_at_a_particular_time_range()
	{
		/** @var Schedule $schedule */
		$schedule = factory(Schedule::class)->create([
			'starts_at' => $start_at = now(),
			'ends_at' => (clone $start_at)->addDays(5),
		]);

		/** @var Resource $resource */
		$resource = factory(Resource::class)->create();

		$resource->availability()->save($schedule);

		// Period should be accepted
		/** @var Schedule $purchasable_period */
		$success_period = factory(Schedule::class)->create([
			'starts_at' => (clone $start_at)->addHours(1),
			'ends_at' => (clone $start_at)->addHours(5),
		]);

		$this->assertTrue($resource->isAvailable($success_period));

		// Period should be refused
		/** @var Schedule $purchasable_period */
		$fail_period = factory(Schedule::class)->create([
			'starts_at' => (clone $start_at)->subHours(1),
			'ends_at' => (clone $start_at)->addHours(5),
		]);

		$this->assertFalse($resource->isAvailable($fail_period));

		// Period should be refused
		/** @var Schedule $purchasable_period */
		$fail_period = factory(Schedule::class)->create([
			'starts_at' => (clone $start_at)->addHours(1),
			'ends_at' => (clone $start_at)->addWeeks(15),
		]);

		$this->assertFalse($resource->isAvailable($fail_period));
	}
}
