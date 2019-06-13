<?php

use Encore\Admin\Auth\Database\Permission;
use Encore\Admin\Auth\Database\Role;
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

        $adminPermission = Permission::query()->where('slug', '*')->pluck('id');
        Role::query()->where('slug', 'administrator')->first()->permissions()->sync($adminPermission);
    }

    private function data()
    {
        return [
            [
                'name' => 'All Permission',
                'slug' => '*',
                'http_method' => '',
                'http_path' => '*'
            ],
            [
                'name' => 'Dashboard',
                'slug' => 'dashboard',
                'http_method' => 'GET',
                'http_path' => '/'
            ],
            [
                'name' => 'Login',
                'slug' => 'auth.login',
                'http_method' => '',
                'http_path' => "/auth/login\n/auth/logout"
            ],
            [
                'name' => 'User Setting',
                'slug' => 'auth.login',
                'http_method' => '',
                'http_path' => "/auth/setting"
            ],
            [
                'name' => 'Auth Management',
                'slug' => 'auth.management',
                'http_method' => '',
                'http_path' => "/auth/roles*\n/auth/permissions*\n/auth/menu*\n/auth/logs*"
            ],
            [
                'name' => '管理员管理相关',
                'slug' => 'admins.any',
                'http_method' => '',
                'http_path' => '/admins*'
            ],
            [
                'name' => '用户管理相关',
                'slug' => 'users.any',
                'http_method' => '',
                'http_path' => '/users*'
            ],
            [
                'name' => '类目管理',
                'slug' => 'classifications.any',
                'http_method' => '',
                'http_path' => '/classifications*'
            ],
            [
                'name' => '类别管理',
                'slug' => 'categories.any',
                'http_method' => '',
                'http_path' => '/categories*'
            ],
            [
                'name' => '服务类型管理',
                'slug' => 'service_types.any',
                'http_method' => '',
                'http_path' => '/service_types*'
            ],
            [
                'name' => '品牌管理',
                'slug' => 'brands.any',
                'http_method' => '',
                'http_path' => '/brands*'
            ],
            [
                'name' => '订单管理',
                'slug' => 'orders.any',
                'http_method' => '',
                'http_path' => '/orders*'
            ],
            [
                'name' => '师傅管理',
                'slug' => 'masters.any',
                'http_method' => '',
                'http_path' => '/masters*'
            ],
        ];
    }
}
