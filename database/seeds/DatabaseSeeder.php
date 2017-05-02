<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 30)
           ->create()
           ->each(function ($user) {
                $business = $user->business()->save(factory(App\Business::class)->make());
                $business->cards()->save(factory(App\Card::class)->make());
            });
    }
}
