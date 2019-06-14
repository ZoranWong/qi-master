<?php

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::truncate();

//        Category::create([
//            'name' => 'root',
//            'parent_id' => 0,
//            'classification_id' => 0,
//        ]);
    }
}
