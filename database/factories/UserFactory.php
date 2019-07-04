<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Models\User::class, function (Faker $faker) {
    /**@var \App\Models\Region $province */
    $province = \App\Models\Region::getProvinces()->first();
    /**@var \App\Models\Region $city */
    $city = $province->children->first();
    /**@var \App\Models\Region $area */
    $area = $city->children->first();
    return [
        'name' => $faker->unique()->name,
        'real_name' => $faker->name,
        'nickname' => $faker->name,
        'sex' => $faker->randomElement([0, 1, 2]),
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'mobile' => $faker->unique()->phoneNumber,
        'province' => $province->name,
        'city' => $city->name,
        'area' => $area->name,
        'balance' => $faker->randomDigit * 1000,
        'address' => $faker->streetAddress,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});
