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
                'name' => '角色管理',
                'slug' => 'roles.any',
                'http_method' => '',
                'http_path' => '/auth/roles*'
            ],
            [
                'name' => '权限管理',
                'slug' => 'permissions.any',
                'http_method' => '',
                'http_path' => '/auth/permissions*'
            ],
            [
                'name' => '菜单相关',
                'slug' => 'menus.any',
                'http_method' => '',
                'http_path' => '/menus*'
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
        ];
    }
}
