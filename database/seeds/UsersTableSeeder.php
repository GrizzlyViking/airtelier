<?php

use Illuminate\Database\Seeder;
use App\Models\User,
    App\Models\Address,
    App\Models\Offer;
use Illuminate\Support\Arr;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 20)->create()->each(function (User $user) {
            $user->address()->associate(factory(Address::class)->make());
            $user->save();
            $user->offers()->saveMany(factory(Offer::class, Arr::random([1,1,1,2,3]))->make());
        });
    }
}
