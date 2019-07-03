<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Master::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'real_name' => $faker->name,
        'avatar' => $faker->imageUrl(64, 64),
        'email_verified_at' => now(),
        'mobile' => $faker->phoneNumber,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
        'balance' => random_int(10000, 1000000),
        'address' => $faker->streetAddress,
        'id_card_no' => ''
    ];
});
