<?php

use App\Models\ComplaintType;
use Illuminate\Database\Seeder;

class ComplaintTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ComplaintType::truncate();

        factory(ComplaintType::class, 20)->create();
    }
}
