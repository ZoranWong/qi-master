<?php

use Faker\Generator as Faker;
use App\Models\Classification;
use App\Models\Category;
use App\Models\ServiceType;

$factory->define(App\Models\Product::class, function (Faker $faker) {
    $image = $faker->randomElement([
        "https://fupo.jp/wp-content/uploads/2019/04/MG_7849-c2.jpg",
        "http://img.fsjiaju.com/Product/2014/1208/20141208144843253u204104.jpg",
        "https://tgi1.jia.com/118/571/18571330.jpg",
        "https://tgi12.jia.com/118/571/18571304.jpg",
        "http://decomyplace.com/img/blog/150616_clei_0.jpg",
        "http://decomyplace.com/img/blog/150616_clei_1.jpg",
        "http://decomyplace.com/img/blog/150616_clei_5.jpg",
        "http://decomyplace.com/img/blog/150616_clei_10.jpg"
    ]);
    $classification = Classification::query()->inRandomOrder()->first();
    $category = Category::where('classification_id', $classification->id)->where('parent_id', 0)->inRandomOrder()->first();
    $childCategory = Category::where('parent_id', $category->id)->inRandomOrder()->first();
    $service =  $classification->serviceTypes()->inRandomOrder()->first();
    return [
        'classification_id' => $classification->id,
        'category_id' => $category->id,
        'child_category_id' => $childCategory ? $childCategory->id : 0,
        'service_id' => $service ? $service->id : 0,
        'title' => $faker->word,
        'image' => $image,
    ];
});
