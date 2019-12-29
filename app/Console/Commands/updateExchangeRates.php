<?php

namespace App\Console\Commands;

use App\Models\Countries;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Stream;
use Illuminate\Console\Command;

class updateExchangeRates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'airtelier:exchange-rate:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the exchange rates';

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
		$client = new Client();
		$request = $client->get('https://api.exchangeratesapi.io/latest');
		$response = \GuzzleHttp\json_decode($request->getBody()->getContents());

		foreach ($response->rates as $currency_code => $rate) {
			Countries::where('currency_code', $currency_code)->update([
				'exchange_rate' => $rate
			]);
		}

		dd();
    }
}
