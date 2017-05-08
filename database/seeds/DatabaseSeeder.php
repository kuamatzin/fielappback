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
                $user->user_type = 2;
                $user->save();
                $business = $user->business()->save(factory(App\Business::class)->make());
                $business->cards()->save(factory(App\Card::class)->make());
            });

        factory(App\User::class, 300)->create()->each(function($user){
            $cards = [random_int(1, 30), random_int(1, 30), random_int(1, 30), random_int(1, 30), random_int(1, 30)];
            $user->cards()->sync($cards);
        });
    }
}
