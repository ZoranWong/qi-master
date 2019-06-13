<?php

namespace App\Admin\Controllers;

use App\Models\Master;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class MasterController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '师傅管理';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Master);
        $grid->actions(function (Grid\Displayers\Actions $actions) {
            $actions->disableDelete();
            $actions->disableEdit();
        });
        $grid->disableCreateButton();
        $grid->column('id', 'ID');
        $grid->column('name', '用户名');
        $grid->column('balance', '账户余额')->display(function ($value) {
            return number_format($value, 2);
        });
        $grid->column('offerOrders', '接单数')->display(function ($value) {
            return count($value);
        });

        $grid->column('runningOrders', '服务中的工单')->display(function ($value) {
            return count($value);
        });

        $grid->column('completedOrders', '完成的工单')->display(function ($value) {
            return count($value);
        });

        $grid->column('email', '邮箱');
        $grid->column('mobile', '手机');
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
        $show = new Show(Master::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('email', __('Email'));
        $show->field('mobile', __('Mobile'));
        $show->field('email_verified_at', __('Email verified at'));
        $show->field('password', __('Password'));
        $show->field('remember_token', __('Remember token'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }
}
