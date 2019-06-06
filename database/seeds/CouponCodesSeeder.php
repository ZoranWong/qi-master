<?php

use App\Models\CouponCode;
use Illuminate\Database\Seeder;

class CouponCodesSeeder extends Seeder
{
    public function run()
    {
        factory(CouponCode::class, 20)->create();
    }
}
