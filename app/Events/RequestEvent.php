<?php

namespace App\Events;

use App\Models\Schedule;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RequestEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

	/** @var Schedule */
	public $schedule;

	/** @var User */
	public $user;

	/**
	 * Create a new event instance.
	 *
	 * @param Schedule $event
	 * @param User $user
	 */
    public function __construct(Schedule $event, User $user)
    {
        $this->schedule = $event;
        $this->user = $user;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('airtelier-channel');
    }

	public function broadcastAs()
	{
		return 'resource-' . $this->schedule->schedulable_id;
    }
}
