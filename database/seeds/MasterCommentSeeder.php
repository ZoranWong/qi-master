<?php

use App\Models\MasterComment;
use Illuminate\Database\Seeder;

class MasterCommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MasterComment::truncate();

        factory(MasterComment::class, 20)->create();
    }
}
