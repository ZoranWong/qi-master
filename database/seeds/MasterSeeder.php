<?php

use App\Models\Master;
use Illuminate\Database\Seeder;
use App\Models\Region;

class MasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Master::truncate();

        $masters = factory(Master::class, 100)->create([
            'password' => bcrypt('secret')
        ]);
        foreach ($masters as $master) {
            /**@var \App\Models\Region $province**/
            $province = Region::inRandomOrder()->where('parent_code', 0)->first();

            /**@var Region $city*/
            $city = $province->children->random(1)->first();

            /**@var Region $area*/
            $area = $city->children->random(1)->first();
            /**
             * @var Master $master
             * */
            $master->areaCode = $area->regionCode;
            $master->save();
        }
    }
}
