<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run()
    {
        User::truncate();
        // 通过 factory 方法生成 100 个用户并保存到数据库中
        factory(User::class, 100)->create([
            'password' => bcrypt('123456')
        ]);
    }
}
