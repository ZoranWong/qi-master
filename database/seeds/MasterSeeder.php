<?php

use App\Models\Master;
use Illuminate\Database\Seeder;

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
            /**@var \App\Models\Region $region**/
            $region = \App\Models\Region::inRandomOrder()->where('parent_code', 0)->first();
            /**
             * @var Master $master
             * */
            $master->areaCode = $region->regionCode;
            $master->save();
        }
    }
}
