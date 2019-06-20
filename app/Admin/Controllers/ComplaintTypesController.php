<?php

namespace App\Admin\Controllers;

use App\Models\ComplaintType;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ComplaintTypesController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '投诉类型';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ComplaintType);

        $grid->column('id', 'ID');
        $grid->column('parent.name', '父类型');
        $grid->column('name', '投诉类型名称');
        $grid->column('children', '子类型数量')->display(function ($value) {
            return count($value);
        });
        $grid->disableActions();
        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(ComplaintType::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('parent_id', __('Parent id'));
        $show->field('name', __('Name'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new ComplaintType);

        $form->select('parent_id', '父类型')->options(ComplaintType::all()->pluck('name', 'id'));
        $form->text('name', '投诉类型名称');

        return $form;
    }
}
