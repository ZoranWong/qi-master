<?php

use App\Models\Product;
use Illuminate\Database\Seeder;
use App\Models\Classification;
use App\Models\Category;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        Product::truncate();
        // 创建 30 个商品
        factory(Product::class, 500)->create();
    }
}
