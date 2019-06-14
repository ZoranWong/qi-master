<?php

use App\Models\Product;
use App\Models\ProductSku;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 创建 30 个商品
        $products = factory(Product::class, 30)->create();
        foreach ($products as $product) {
            /**@var Product $product**/
            $product;
        }
    }
}
