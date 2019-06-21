<?php

use App\Models\Complaint;
use App\Models\ComplaintType;
use App\Models\Order;
use Faker\Generator as Faker;

$factory->define(Complaint::class, function (Faker $faker) {
    /** @var ComplaintType $complaintType */
    $complaintType = ComplaintType::inRandomOrder()->first();

    $status = $faker->randomElement(array_keys(Complaint::STATUS));

    $evidenceStatus = $faker->randomElement(array_keys(Complaint::STATUS_EVIDENCE));

    /** @var Order $order */
    $order = Order::inRandomOrder()->first();

    $images = $faker->randomElements([
        "https://fupo.jp/wp-content/uploads/2019/04/MG_7849-c2.jpg",
        "http://img.fsjiaju.com/Product/2014/1208/20141208144843253u204104.jpg",
        "https://tgi1.jia.com/118/571/18571330.jpg",
        "https://tgi12.jia.com/118/571/18571304.jpg",
        "http://decomyplace.com/img/blog/150616_clei_0.jpg",
        "http://decomyplace.com/img/blog/150616_clei_1.jpg",
        "http://decomyplace.com/img/blog/150616_clei_5.jpg",
        "http://decomyplace.com/img/blog/150616_clei_10.jpg"
    ], 3, false);

    $model = [
        'complaint_no' => orderNo('C'),
        'order_id' => $order->id,
        'order_no' => $order->orderNo,
        'complaint_type' => $complaintType->id,
        'status' => $status,
        'evidence_status' => $evidenceStatus,
        'complaint_info' => [
            'content' => $faker->sentence(20),
            'images' => $images
        ],
        'result' => [],
        'compensation' => rand(1, 100) * CURRENCY_UNIT_CONVERT_NUM
    ];

    if ($model['status'] === Complaint::STATUS_FINISHED) {
        $model['result'] = [
            'title' => $faker->sentence,
            'type_title' => $faker->sentence,
            'content' => $faker->sentence(20),
            'time' => $faker->dateTime->format('Y-m-d H:i:s'),
        ];
    }

    return $model;
});
