<?php

use App\Models\Address;
use App\Models\Price;
use App\Models\Resource;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class StandardValues extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {

            $user = User::updateOrCreate(
	            ['email' => 'sebastian@edelmann.co.uk'],
	            [
		            'name'     => 'Sebastian Scheel Edelmann',
		            'email'    => 'sebastian@edelmann.co.uk',
		            'password' => Hash::make('V1k1ng053c0')
	            ]
            );
            $address = Address::updateOrCreate(
	            [
		            'name'    => 'home',
		            'address' => 'Ben Websters Vej 92, st.',
	            ],
	            [
		            'name'         => 'home',
		            'address'      => 'Ben Websters Vej 92, st.',
		            'post_code'    => '2450',
		            'town'         => 'København SV',
		            'country_code' => 'DK',
	            ]
            );
			$user->addresses()->attach($address);

	        /** @var User $event_user */
	        $lars = User::updateOrCreate(
		        [
			        'email' => 'lars@bayer.dk',
		        ],
		        [
			        'name'     => 'Lars Bayer',
			        'email'    => 'lars@bayer.dk',
			        'password' => Hash::make('password')
		        ]);

	        $address_lars = Address::updateOrCreate(
	        	[
			        'address'      => 'Ben Websters Vej 88, st.',
		        ],
		        [
			        'name'         => 'home',
			        'address'      => 'Ben Websters Vej 88, st.',
			        'post_code'    => '2450',
			        'town'         => 'København SV',
			        'country_code' => 'DK',
		        ]
	        );
	        $lars->addresses()->attach($address_lars);

	        /** @var Resource $skill */
	        $skill = Resource::updateOrCreate(
		        ['slug' => 'sluseholmen-dog-walking'],
		        [
			        'title'       => 'Dog walker',
			        'sub_title'   => 'Sluseholmen dog walking',
			        'slug'        => 'sluseholmen-dog-walking',
			        'description' => '<p>Walking dogs in Sluseholmen</p>',
			        'type_id'     => 1,
			        'owner_id'    => $lars->id
		        ]
	        );

	        Price::updateOrCreate([
		        'amount' => 120,
		        'tax_rate' => 0.25,
		        'unit_size' => 1,
		        'unit_type' => 'hour',
		        'currency_code' => 'DKK',
		        'priceable_id' => $skill->getKey(),
		        'priceable_type' => $skill->getMorphClass()
	        ]);

	        $beginning_of_day = Carbon::parse('2020-05-1 08:00:00');
	        $end_of_day = Carbon::parse('2020-05-1 17:00:00');
	        $end_of_month = (clone $end_of_day)->endOfMonth();

	        while ($end_of_day < $end_of_month) {
		        if (!$beginning_of_day->isWeekend()) {
			        $skill->generateAvailability('Dog walking', (clone $beginning_of_day), (clone $end_of_day));
		        }
		        $beginning_of_day->addDay();
		        $end_of_day->addDay();
	        }
        } catch (Exception $e) {
            dump($e->getMessage());
        }
    }
}
