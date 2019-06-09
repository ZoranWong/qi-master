<?php

use App\Models\Classification;
use Faker\Generator as Faker;

$factory->define(Classification::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'icon_url' => $faker->url,
        'is_hot' => $faker->boolean,
        'is_new' => $faker->boolean,
        'sort' => 0,
        'status' => 1
    ];
});
