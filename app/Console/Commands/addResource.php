<?php

namespace App\Console\Commands;

use App\Models\ResourceType;
use Illuminate\Console\Command;

class addResource extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'airtelier:resource:add {newResource}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Adds a new resource, and updates config.';

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
    	// ResourceType::create(['type' => $this->argument('newResource')]);

    	config(['airtelier.resource_types' => ResourceType::pluck('type')]);
    }
}
