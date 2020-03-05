<?php

namespace Tests\Unit;

use App\Models\Resource;
use App\Models\Schedule;
use Tests\TestCase;

class ScheduleTest extends TestCase
{
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

		$resource->schedules()->save($event);
	}
}
