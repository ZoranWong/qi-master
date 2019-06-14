<?php

use Illuminate\Database\Seeder;
use App\Models\Classification;

class ClassificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Classification::truncate();
        $classifications = factory(Classification::class, 5)->create();
        $names = [
            "家具",
            "卫浴",
            "灯具",
            "装修",
            "家电"
        ];
        foreach ($classifications as $key => $classification) {
            $classification->update(['name' => $names[$key]]);
        }
    }
}
