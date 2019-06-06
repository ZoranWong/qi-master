<?php


namespace App\Admin\Controllers;


use App\Http\Controllers\Controller;
use Encore\Admin\Auth\Database\Menu;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;

class MenusController extends Controller
{
    use HasResourceActions;

    public function index(Content $content)
    {
        return $content->header('菜单列表')
            ->body($this->grid());
    }

    public function create(Content $content)
    {
        return $content->header('创建菜单')
            ->body($this->form());
    }

    public function form()
    {
        $form = new Form(new Menu);

        $form->text('title', '菜单名称')->rules('required');
        $form->text('icon', '图标')->rules('required');
        $form->text('uri', 'URI')->rules('nullable|string');

        return $form;
    }

    public function grid()
    {
        $grid = new Grid(new Menu);

        $grid->id('ID')->sortable();
        $grid->title('标题');
        $grid->icon('图标')->display(function ($value) {
            return "<i class='fa {$value}'></i>";
        });
        $grid->uri('URI');
        $grid->order('排序')->sortable();

        return $grid;
    }
}
