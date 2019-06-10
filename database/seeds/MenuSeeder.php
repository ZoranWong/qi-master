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
            'title' => 'Dashboard',
            'icon' => 'fa-bar-chart',
            'uri' => '/',
            'permission' => ''
        ]);

        Menu::query()->create([
            'parent_id' => 0,
            'title' => '菜单管理',
            'icon' => 'fa-bars',
            'uri' => 'auth/menu',
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
                'icon' => 'fa-ban',
                'uri' => 'auth/permissions',
                'permission' => ''
            ],
            [
                'title' => '角色管理',
                'icon' => 'fa-user',
                'uri' => 'auth/roles',
                'permission' => ''
            ],
            [
                'title' => '管理员管理',
                'icon' => 'fa-users',
                'uri' => 'admins',
                'permission' => ''
            ],
            [
                'title' => '操作日志',
                'icon' => 'fa-history',
                'uri' => 'auth/logs',
                'permission' => ''
            ]
        ]);

        $parentMenu = Menu::query()->create([
            'parent_id' => 0,
            'title' => '用户管理',
            'icon' => 'fa-users',
            'uri' => '/',
            'permission' => ''
        ]);

        $parentMenu->children()->createMany([
            [
                'title' => '用户管理',
                'icon' => 'fa-asl-interpreting',
                'uri' => 'users',
                'permission' => ''
            ],
            [
                'title' => '师傅管理',
                'icon' => 'fa-asl-interpreting',
                'uri' => 'masters',
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
                'uri' => 'classifications',
                'permission' => ''
            ],
            [
                'title' => '类别管理',
                'icon' => 'fa-cogs',
                'uri' => 'categories',
                'permission' => ''
            ],
            [
                'title' => '服务类型管理',
                'icon' => 'fa-asl-interpreting',
                'uri' => 'service_types',
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
                'uri' => 'brands',
                'permission' => ''
            ]
        ]);

        $parentMenu = Menu::query()->create([
            'parent_id' => 0,
            'title' => '订单管理',
            'icon' => 'fa-first-order',
            'uri' => '',
            'permission' => ''
        ]);

        $parentMenu->children()->createMany([
            [
                'title' => '订单管理',
                'icon' => 'fa-bandcamp',
                'uri' => 'orders',
                'permission' => ''
            ],
            [
                'title' => '退款管理',
                'icon' => 'fa-money',
                'uri' => 'refund/orders',
                'permission' => ''
            ]
        ]);

        $parentMenu = Menu::query()->create([
            'parent_id' => 0,
            'title' => '提现管理',
            'icon' => 'fa-ambulance',
            'uri' => '',
            'permission' => ''
        ]);

        $parentMenu->children()->createMany([
            [
                'title' => '提现订单',
                'icon' => 'fa-bandcamp',
                'uri' => 'orders',
                'permission' => ''
            ]
        ]);
    }
}
