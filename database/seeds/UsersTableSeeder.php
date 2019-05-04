<?php

use Illuminate\Database\Seeder;
use App\Models\User,
    App\Models\Location,
    App\Models\Resource,
    App\Models\Service;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(
            [
                'name' => 'Sebastian Scheel Edelmann',
                'email' => 'sebastian@edelmann.co.uk',
                'password' => Hash::make('V1k1ng053c0'),
            ]
        );

        factory(User::class, 20)->create()->each(function(User $user) {
            $user->locations()->save(factory(Location::class)->make());
        });

        factory(User::class, 10)->create()->each(function(User $user) {
            $user->resources()->save(factory(Resource::class)->make());
        });

        factory(User::class, 10)->create()->each(function(User $user) {
            $user->services()->save(factory(Service::class)->make());
        });
    }
}
