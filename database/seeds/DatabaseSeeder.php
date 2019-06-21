<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(AdminSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(MasterSeeder::class);
        $this->call(UserAddressesSeeder::class);
        $this->call(ClassificationSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(ProductsSeeder::class);
        $this->call(CouponCodesSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(MenuSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(ServiceTypeSeeder::class);
        $this->call(WithdrawOrdersSeeder::class);
        $this->call(ComplaintTypeSeeder::class);
        $this->call(ComplaintSeeder::class);
    }
}
