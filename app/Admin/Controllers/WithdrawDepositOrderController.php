<?php

namespace App\Admin\Controllers;

use App\Models\WithdrawDepositOrder;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class WithdrawDepositOrderController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '提现管理';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new WithdrawDepositOrder);
        $grid->disableCreateButton();
        $grid->actions(function (Grid\Displayers\Actions $actions) {
            $actions->disableEdit();
            $actions->disableDelete();
        });
        $grid->column('id', 'ID');
        $grid->column('master.name', '申请提现师傅');
        $grid->column('apply_amount', '申请提现金额')->display(function ($value) {
            return number_format($value, 2);
        });
        $grid->column('transfer_amount', '实际转账金额')->display(function ($value) {
            return number_format($value, 2);
        });
        $grid->column('created_at', '申请时间');
        $grid->column('updated_at', '处理时间');
        $grid->column('status', '状态')->display(function ($value, Grid\Column $column) {
            $label = 'warning';
            switch ($value) {
                case  WithdrawDepositOrder::HANDLING:
                    {
                        $label = 'warning';
                        break;
                    }
                case WithdrawDepositOrder::AGREE_WITHDRAW:
                    {
                        $label = 'success';
                        break;
                    }
                case WithdrawDepositOrder::REFUSE_WITHDRAW:
                    {
                        $label = 'error';
                        break;
                    }
            }
            return "<span class='label label-{$label}'>" . WithdrawDepositOrder::STATUS_DESC[$value] . "</span>";

        });
        $grid->column('comment', '说明');
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
        $show = new Show(WithdrawDepositOrder::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('apply_amount', __('Apply amount'));
        $show->field('transfer_amount', __('Transfer amount'));
        $show->field('master_id', __('Master id'));
        $show->field('status', __('Status'));
        $show->field('comment', __('Comment'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('deleted_at', __('Deleted at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new WithdrawDepositOrder);

        $form->number('apply_amount', __('Apply amount'));
        $form->number('transfer_amount', __('Transfer amount'));
        $form->number('master_id', __('Master id'));
        $form->switch('status', __('Status'));
        $form->textarea('comment', __('Comment'));

        return $form;
    }
}
