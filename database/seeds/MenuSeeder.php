<?php

use Encore\Admin\Auth\Database\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Menu::query()->truncate();

        Menu::query()->create([
            'parent_id' => 0,
            'title' => '菜单管理',
            'icon' => 'fa-balance-scale',
            'uri' => '/menus',
            'permission' => ''
        ]);

        $parentMenu = Menu::query()->create([
            'parent_id' => 0,
            'title' => '基本配置',
            'icon' => 'fa-cube',
            'uri' => '',
            'permission' => ''
        ]);

        $parentMenu->children()->createMany([
            [
                'title' => '权限管理',
                'icon' => 'fa-tasks',
                'uri' => '/auth/permissions',
                'permission' => ''
            ],
            [
                'title' => '角色管理',
                'icon' => 'fa-cogs',
                'uri' => '/auth/roles',
                'permission' => ''
            ],
            [
                'title' => '管理员管理',
                'icon' => 'fa-asl-interpreting',
                'uri' => '/admins',
                'permission' => ''
            ],
            [
                'title' => '用户管理',
                'icon' => 'fa-asl-interpreting',
                'uri' => '/users',
                'permission' => ''
            ]
        ]);

        $parentMenu = Menu::query()->create([
            'parent_id' => 0,
            'title' => '分类管理',
            'icon' => 'fa-cube',
            'uri' => '',
            'permission' => ''
        ]);

        $parentMenu->children()->createMany([
            [
                'title' => '类目管理',
                'icon' => 'fa-tasks',
                'uri' => '/classifications',
                'permission' => ''
            ],
            [
                'title' => '类别管理',
                'icon' => 'fa-cogs',
                'uri' => '/categories',
                'permission' => ''
            ],
            [
                'title' => '服务类型管理',
                'icon' => 'fa-asl-interpreting',
                'uri' => '/service-types',
                'permission' => ''
            ]
        ]);

        $parentMenu = Menu::query()->create([
            'parent_id' => 0,
            'title' => '商品管理',
            'icon' => 'fa-shopping-cart',
            'uri' => '',
            'permission' => ''
        ]);

        $parentMenu->children()->createMany([
            [
                'title' => '品牌管理',
                'icon' => 'fa-bandcamp',
                'uri' => '/brands',
                'permission' => ''
            ]
        ]);
    }
}
