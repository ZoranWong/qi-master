<?php

use App\Models\ComplaintType;
use Faker\Generator as Faker;

$factory->define(ComplaintType::class, function (Faker $faker) {
    return [
        'parent_id' => rand(0, 10),
        'name' => $faker->sentence(5)
    ];
});
