<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Auth\Database\Permission;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;

class PermissionsController extends Controller
{
    use HasResourceActions;

    public function index(Content $content)
    {
        return $content->header('权限列表')
            ->body($this->grid());
    }

    public function create(Content $content)
    {
        return $content->header('新建权限')
            ->body($this->form());
    }

    public function form()
    {
        $form = new Form(new Permission);

        $form->text('name', '权限名称');

        $form->text('slug', '标识');

        return $form;
    }

    public function grid()
    {
        $grid = new Grid(new Permission);

        $grid->id('ID')->sortable();

        $grid->name('权限名称');

        $grid->slug('标识');

        $grid->http_method('请求方法');

        $grid->http_path('请求路径');

        return $grid;
    }

}
