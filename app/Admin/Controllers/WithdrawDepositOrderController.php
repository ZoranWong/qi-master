<?php

namespace App\Admin\Controllers;

use App\Models\WithdrawDepositOrder;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Illuminate\View\View;

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
        $grid->column('operator', '处理人员')->display(function ($value) {
            return $value ? $value['name'] : '--无人受理--';
        });

        $grid->actions(function (Grid\Displayers\Actions $actions) {
            /**@var WithdrawDepositOrder $order * */
            $order = $actions->row;
            $actions->disableDelete();
            $actions->disableEdit();
            $actions->disableView();
            if ($order->status === WithdrawDepositOrder::HANDLING) {
                $actions->append("<a class='btn btn-sm btn-primary withdraw-agree' data-id='{$order->id}' data-fee='{$order->applyAmount}'>同意</a>
<a class='btn btn-sm btn-dark withdraw-refuse' data-id='{$order->id}'>拒绝</a> ");
            }
        });
        $this->agreeWithdraw();
        $this->refuseWithdraw();
        return $grid;
    }

    protected function agreeWithdraw()
    {
        $view = view('admin.withdraw.agree_withdraw')->with([
            'admin_id' => auth('admin')->id()
        ]);
        $route = route('admin.withdraw.update');
        $token = csrf_token();
        $script = <<<SCRIPT
        $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': '$token' 
  }
});
let agreeTemplate = `$view`;
$(document).off('click', '.withdraw-agree');
$(document).on('click', '.withdraw-agree', function () {
    let id = $(this).data('id');
    let amount = $(this).data('fee');
    swal({
        title: '同意提现',
        html: agreeTemplate,
        width: '720px',
        confirmButtonText: '同意'
    }).then(function (data) {
         let form = $('.agree-form').serializeArray();
         let formData = {
            comment: '',
            transfer_amount: 0
         };
         form.forEach((data) => {
            formData[data['name']] = data['value'];
         });
         if(formData['transfer_amount'] > 0 && formData['comment'] && formData['transfer_amount'] <= amount) { 
            swal('确定同意提现').then(() => {
                $.ajax({
                    url: '{$route}/'+id, 
                    method: 'PUT',
                    data: formData,
                    dataType: 'json',
                    success: (res) => {
                        if(res.status) {
                            swal('转账成功').then(() => {
                                location.reload();
                            });
                        } 
                    }
                });
             });
         }else if(formData['transfer_amount'] === 0 || !formData['comment'] ){
            swal("数据不全无法提交", "请输入转账金额与说明", "error");
         }else if(formData['transfer_amount'] > amount){ 
            swal("数据错误", "请输入转账金额不能大于申请金额", "error");
         }
         
    });
});
SCRIPT;

        Admin::script($script);
    }

    protected function refuseWithdraw()
    {
        $view = view('admin.withdraw.refuse_withdraw')->with([
            'admin_id' => auth('admin')->id()
        ]);
        $route = route('admin.withdraw.update');
        $token = csrf_token();
        $script = <<<SCRIPT
        $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': '$token' 
  }
});
let refuseTemplate = `$view`;
$(document).off('click', '.withdraw-refuse');
$(document).on('click', '.withdraw-refuse', function () {
    let id = $(this).data('id');
    refuseTemplate = $(refuseTemplate);
    refuseTemplate.find('.order-id').val(id);
    swal({
        title: '拒绝提现',
        html: refuseTemplate,
        width: '720px',
        confirmButtonText: '拒绝'
    }).then(function (data) {
         let form = $('.refuse-form').serializeArray();
         let formData = {};
         form.forEach((data) => {
            formData[data['name']] = data['value'];
         });
         swal('确定拒绝提现').then(() => {
            $.ajax({
                url: '{$route}/'+id, 
                method: 'PUT',
                data: formData,
                dataType: 'json',
                success: (res) => {
                    if(res.status) {
                        swal('以拒绝师傅提现').then(() => {
                            location.reload();
                        });
                    } 
                }
            });
         });
    });
});
SCRIPT;

        Admin::script($script);
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

    public function update($id)
    {
        $order = WithdrawDepositOrder::find($id);
        $result = $order->update(Request::toArray());
        if ($result) {
            return response()->json([
                'status' => true
            ]);
        } else {
            return response()->json([
                'status' => false
            ]);
        }
    }
}
