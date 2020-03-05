<?php

namespace App\Observers;

use App\Models\Schedule;

class ScheduleObserver
{
    /**
     * Handle the schedule "created" event.
     *
     * @param Schedule $schedule
     *
     * @return void
     */
    public function created(Schedule $schedule)
    {
        if (empty($schedule->uid)) {
			$schedule->update(['uid' => $schedule->generateUniqueID()]);
		}
    }

    /**
     * Handle the schedule "updated" event.
     *
     * @param Schedule $schedule
     *
     * @return void
     */
    public function updated(Schedule $schedule)
    {
        //
    }

    /**
     * Handle the schedule "deleted" event.
     *
	 * @param Schedule  $schedule
     *
     * @return void
     */
    public function deleted(Schedule $schedule)
    {
        //
    }

    /**
     * Handle the schedule "restored" event.
	 *
	 * @param  Schedule  $schedule
     *
     * @return void
     */
    public function restored(Schedule $schedule)
    {
        //
    }

    /**
     * Handle the schedule "force deleted" event.
	 *
	 * @param  Schedule  $schedule
     *
     * @return void
     */
    public function forceDeleted(Schedule $schedule)
    {
        //
    }
}
