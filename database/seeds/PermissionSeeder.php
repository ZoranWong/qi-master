<?php

use Encore\Admin\Auth\Database\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::query()->truncate();

        $permissions = $this->data();
        foreach ($permissions as $permission) {
            Permission::query()->create($permission);
        }
    }

    private function data()
    {
        return [
            [
                'name' => '后台首页',
                'slug' => 'admin',
                'http_method' => 'GET',
                'http_path' => '/'
            ],
            [
                'name' => '用户列表',
                'slug' => 'users',
                'http_method' => 'GET',
                'http_path' => '/users'
            ],
            [
                'name' => '产品列表',
                'slug' => 'products',
                'http_method' => 'GET',
                'http_path' => '/products'
            ],
            [
                'name' => '产品创建页面',
                'slug' => 'products.create',
                'http_method' => 'GET',
                'http_path' => '/products/create'
            ],
            [
                'name' => '产品创建',
                'slug' => 'products',
                'http_method' => 'POST',
                'http_path' => '/products'
            ],
        ];
    }
}
