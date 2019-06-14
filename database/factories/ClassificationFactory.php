<?php

use App\Models\Classification;
use Faker\Generator as Faker;

$factory->define(Classification::class, function (Faker $faker) {
    return [
        'name' => '',
        'icon_url' => $faker->imageUrl(64, 64),
        'is_hot' => $faker->boolean,
        'is_new' => $faker->boolean,
        'sort' => 0,
        'status' => 1
    ];
});
