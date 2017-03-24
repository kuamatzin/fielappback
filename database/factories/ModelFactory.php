<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});


$factory->define(App\Business::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->company,
        'businesses_type' => $faker->name,
        'logo' => $faker->imageUrl($width = 300, $height = 300)
    ];
});

$factory->define(App\Card::class, function (Faker\Generator $faker) {
    return [
        'business_id' => random_int(1, 30),
        'uses' => 5,
        'reward' => $faker->sentence,
        'expiration' => $faker->date($format = 'Y-m-d', $max = 'now')
    ];
});





