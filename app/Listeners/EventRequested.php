<?php

namespace App\Listeners;

use App\Events\RequestEvent;
use App\Models\Currency;
use App\Models\Transaction;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class EventRequested
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  RequestEvent  $event
     * @return void
     */
    public function handle(RequestEvent $event)
    {
	    Transaction::updateOrCreate(
	    	[
	    		'user_id' => $event->user->id,
			    'paid_for_type' => $event->schedule->getMorphClass(),
			    'paid_for_id' => $event->schedule->getKey(),
		    ],
		    [
			    'user_id' => $event->user->id,
			    'paid_for_type' => $event->schedule->getMorphClass(),
			    'paid_for_id' => $event->schedule->getKey(),
			    'currency' => $event->schedule->schedulable->price->currency->code,
			    'exchange_rate' => $event->schedule->schedulable->price->currency->exchange_rate,
			    'amount' => $event->schedule->schedulable->price->amount,
		    ]
	    );
    	// status updated
	    $event->schedule->update([
		    'status' => 'requested'
	    ]);
        // TODO: notify owner of resource that an event has been requested.
	    Log::channel('slack')->debug($event->schedule->name . ' has changed status from available to ' . $event->schedule->status);
    }
}
