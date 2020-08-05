<?php

namespace App\Console\Commands\Resource;

use App\Models\Resource;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Console\Command;

class RequestEvent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'resource:request
                                {--resource-id=}
                                {--from= : when does the event start}
                                {--till= : when does the event end}
                                {--event-id= : set a specific events status to requested}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set an event to requested';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
    	if ($this->option('event-id')) {
    		/** @var Schedule $event */
		    $event = Schedule::findOrFail($this->option('event-id'));
		    event(new \App\Events\RequestEvent($event, User::where('email', 'sebastian@edelmann.co.uk')->first()));
	    } else {
		    $resource = Resource::findOrFail($this->argument('resource-id'));
	    }
    }
}
