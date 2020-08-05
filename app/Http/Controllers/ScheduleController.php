<?php

namespace App\Http\Controllers;

use App\Models\Resource;
use App\Models\Schedule;
use App\Events\RequestEvent;
use Illuminate\Http\Request;
use App\Models\User;

class ScheduleController extends Controller
{
	public function availability(Resource $resource, string $date)
	{
		return $resource->fetchAvailable($date);
	}

	public function calendar(Resource $resource)
	{
		return view('frontend.calendar', compact('resource'));
	}

	public function request(Schedule $schedule)
	{
		// TODO: $user = Auth::user();
		$user = User::where('email', 'sebastian@edelmann.co.uk')->first();
		$schedule->update(['status' => 'requested']);
		event(new RequestEvent($schedule, $user));
	}
}
