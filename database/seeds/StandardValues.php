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
            factory(User::class, 1)->create()->each(function (User $user) {
                $user->name = 'Sebastian Scheel Edelmann';
                $user->email = 'sebastian@edelmann.co.uk';
                $user->password = Hash::make('V1k1ng053c0');
                $user->address()->associate(factory(Address::class)->make());
                $user->save();
            });
        } catch (Exception $e) {
            echo 'admin already imported.';
        }
    }
}
