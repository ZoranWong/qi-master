<?php

use Illuminate\Database\Seeder;
use App\Models\WithdrawDepositOrder;
class WithdrawOrdersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        WithdrawDepositOrder::truncate();
        factory(WithdrawDepositOrder::class, 100)->create();
    }
}
