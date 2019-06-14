<?php

use Faker\Generator as Faker;
use App\Models\Category;

$factory->define(Category::class, function (Faker $faker) {
    return [
        //
        'parent_id' => 0,
        'classification_id' => 1,
        'name' => $faker->name,
        'sort' => $faker->randomDigit
    ];
});
