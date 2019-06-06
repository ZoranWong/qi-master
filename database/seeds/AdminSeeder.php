<?php

use Encore\Admin\Auth\Database\Administrator;
use Encore\Admin\Auth\Database\Permission;
use Encore\Admin\Auth\Database\Role;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Administrator::query()->truncate();

        /** @var Administrator $admin */
        $admin = factory(Administrator::class)->create();

        /** @var Role $role */
        Role::query()->truncate();

        $role = Role::create([
            'name' => '超级管理员',
            'slug' => 'administrator'
        ]);

        $admin->roles()->attach($role->id);

        $permissionIds = Permission::all()->pluck('id');

        $role->permissions()->sync($permissionIds);
    }
}
