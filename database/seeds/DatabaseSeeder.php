<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(StandardValues::class);
        $this->call(ArticlesSeeder::class);
        $this->call(ImageSeeder::class);
    }
}
