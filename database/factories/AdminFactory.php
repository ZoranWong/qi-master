<?php

use Encore\Admin\Auth\Database\Administrator;
use Faker\Generator as Faker;

$factory->define(Administrator::class, function (Faker $faker) {
    return [
        'username' => $faker->userName,
        'password' => bcrypt('123456'),
        'name' => $faker->name,
        'remember_token' => str_random(10)
    ];
});
