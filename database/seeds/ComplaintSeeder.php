<?php

use App\Models\Complaint;
use App\Models\ComplaintItem;
use Faker\Generator;
use Illuminate\Database\Seeder;

class ComplaintSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Complaint::truncate();
        ComplaintItem::truncate();
        $faker = app(Generator::class);

        $complaints = factory(Complaint::class, 20)->create();

        foreach ($complaints as $complaint) {
            $this->complaintItems($complaint, $faker);
        }
    }

    protected function complaintItems(Complaint $complaint, Generator $faker)
    {
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

        $count = $faker->randomDigitNotNull % 10;
        for ($i = 0; $i < $count; $i++) {
            $complaintItem = new ComplaintItem();
            if ($i % 2 === 0) {
                $complaintItem->complainantId = $complaint->order->masterId;
                $complaintItem->complainantType = TYPE_MASTER;
            } else {
                $complaintItem->complainantId = $complaint->order->userId;
                $complaintItem->complainantType = TYPE_USER;
            }
            $complaintItem->content = $faker->sentence(20);
            $complaintItem->evidence = [
                'images' => $images
            ];
            $complaint->items()->save($complaintItem);
        }
    }
}
