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
                'name' => '菜单列表',
                'slug' => 'menus',
                'http_method' => 'GET',
                'http_path' => '/menus'
            ],
            [
                'name' => '创建菜单页面',
                'slug' => 'menus.create',
                'http_method' => 'GET',
                'http_path' => '/menus/create'
            ],
            [
                'name' => '新建菜单',
                'slug' => 'menus.update',
                'http_method' => 'POST',
                'http_path' => '/menus'
            ],
            [
                'name' => '类目列表',
                'slug' => 'classifications',
                'http_method' => 'GET',
                'http_path' => '/classifications'
            ],
            [
                'name' => '类别列表',
                'slug' => 'categories',
                'http_method' => 'GET',
                'http_path' => '/categories'
            ],
            [
                'name' => '服务类型列表',
                'slug' => 'service_types',
                'http_method' => 'GET',
                'http_path' => '/service_types'
            ],
            [
                'name' => '权限列表',
                'slug' => 'permissions',
                'http_method' => 'GET',
                'http_path' => '/permissions'
            ],
            [
                'name' => '新增权限页面',
                'slug' => 'permissions.create',
                'http_method' => 'GET',
                'http_path' => '/permissions/create'
            ],
            [
                'name' => '新增权限',
                'slug' => 'permissions.store',
                'http_method' => 'POST',
                'http_path' => '/permissions'
            ],
            [
                'name' => '角色列表',
                'slug' => 'roles',
                'http_method' => 'GET',
                'http_path' => '/roles'
            ],
            [
                'name' => '新增角色页面',
                'slug' => 'roles.create',
                'http_method' => 'GET',
                'http_path' => '/roles/create'
            ],
            [
                'name' => '新增角色',
                'slug' => 'roles.store',
                'http_method' => 'POST',
                'http_path' => '/roles'
            ]
        ];
    }
}
