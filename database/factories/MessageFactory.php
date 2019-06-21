<?php

use App\Models\Master;
use App\Models\Message;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(Message::class, function (Faker $faker) {
    $memberType = $faker->randomElement([TYPE_USER, TYPE_MASTER]);

    /** @var User|Master $member */
    $member = ("App\\Models\\" . ucfirst($memberType))::inRandomOrder()->first();

    return [
        'member_id' => $member->id,
        'member_type' => $memberType,
        'title' => $faker->sentence(5),
        'type' => rand(1, 10),
        'content' => $faker->sentence(20),
        'status' => $faker->randomElement([Message::STATUS_NEW, Message::STATUS_READ]),
    ];
});
