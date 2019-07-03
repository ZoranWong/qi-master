<?php

use Illuminate\Database\Seeder;
use App\Models\Master;
use App\Models\Region;
use App\Models\MasterService;
use Faker\Generator;
class MasterServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        MasterService::truncate();
        $masters = Master::all();
        $faker = app(Generator::class);
        $types = [
            MasterService::TYPE_CORE,
            MasterService::TYPE_KEY,
            MasterService::TYPE_OTHER
        ];
        $weights = [
            MasterService::TYPE_CORE => MasterService::WEIGHT_CORE,
            MasterService::TYPE_KEY => MasterService::WEIGHT_KEY,
            MasterService::TYPE_OTHER => MasterService::WEIGHT_OTHER
        ];

        $masters->map(function (Master $master)use ($faker, $types, $weights) {
            $master->services()->delete();
            $count = random_int(1, 1000) % 3 + 1;
            $masterServices = [];
            for ($i = 0; $i < $count; $i ++) {
                /**@var \App\Models\Region $province**/
                $province = Region::inRandomOrder()->where('parent_code', 0)->first();

                /**@var Region $city*/
                $city = $province->children->count() > 0 ? $province->children->random(1)->first() : null;

                /**@var Region $area*/
                $area = $city && $city->children->count() > 0 ? $city->children->random(1)->first() : null;

                $masterService = new MasterService();
                $masterService->regionCode = $area ? $area->regionCode : ($city ? $city->regionCode : $province->regionCode);
                $masterService->type = $types[$i];
                $masterService->weight = $weights[$masterService->type];
                $masterServices[] = $masterService;
            }
            $master->serviceAreas()->saveMany($masterServices);
        });
    }
}
