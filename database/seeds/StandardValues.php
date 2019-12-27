<?php

use App\Models\Address;
use App\Models\User;
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
            $user = factory(User::class)->create([
            	'name' => 'Sebastian Scheel Edelmann',
				'email' => 'sebastian@edelmann.co.uk',
				'password' => Hash::make('V1k1ng053c0')
			]);
			$user->address()->attach(factory(Address::class)->make());
        } catch (Exception $e) {
            echo 'admin already imported.';
        }
    }
}
