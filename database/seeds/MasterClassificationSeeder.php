<?php

use App\Models\Classification;
use App\Models\Master;
use Illuminate\Database\Seeder;

class MasterClassificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $masters = Master::all();

        $masters->map(function (Master $master) {
            $master->services()->delete();
            /**
             * @var Classification $classification
             * */
            $classification = Classification::inRandomOrder()->first();
            $data['classification_id'] = $classification->id;
            $data['services'] = $classification->serviceTypes->map(function (\App\Models\ServiceType $serviceType) {
                return [
                    'id' => $serviceType->id,
                    'name' => $serviceType->name
                ];
            })->toArray();
            $master->services()->create($data);
        });
    }
}
