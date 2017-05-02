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
    $businesses_type = [
        'Comida',
        'Belleza',
        'Entretenimiento',
        'Librerias'
    ];

    return [
        'name' => $faker->company,
        'businesses_type' => $businesses_type[random_int(0, 3)],
        'logo' => $faker->imageUrl($width = 300, $height = 300)
    ];
});

$factory->define(App\Card::class, function (Faker\Generator $faker) {
    $reward = random_int(10, 100);
    return [
        'uses' => 5,
        'reward' => $reward,
        'image' => $faker->imageUrl($width = 600, $height = 300),
        'description' => "Obten un $reward % en tu próxima compra al completar tu tarjeta",
        'expiration' => $faker->date($format = 'Y-m-d', $max = 'now')
    ];
});





