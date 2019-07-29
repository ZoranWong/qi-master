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
            $city = $province && $province->children->count() > 0 ? $province->children->random(1)->first() : null;

            /**@var Region $area*/
            $area = $city && $city->children->count() > 0 ? $city->children->random(1)->first() : null;
//            dd($area);
            /**
             * @var Master $master
             * */
            $master->areaCode = $area ? $area->regionCode : ($city ? $city->regionCode : $province->regionCode);;
            $master->save();
        }
    }
}
