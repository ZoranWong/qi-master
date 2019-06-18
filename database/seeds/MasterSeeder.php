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

        factory(Master::class, 100)->create([
            'password' => bcrypt('secret')
        ]);
    }
}
