<?php

namespace App\Admin\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class UsersController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('用户列表')
            ->body($this->grid());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new User);

        // 创建一个列名为 ID 的列，内容是用户的 id 字段
        $grid->id('ID');

        // 创建一个列名为 用户名 的列，内容是用户的 name 字段。下面的 email() 和 created_at() 同理
        $grid->name('用户名');

        $grid->mobile('手机');

        $grid->email('邮箱');
        $grid->column('orders', '发布服务工单数')->display(function ($value) {
            return count($value);
        });

        $grid->column('completedOrders', '完成服务工单数')->display(function ($value) {
            return count($value);
        });

        $grid->column('runningOrders', '进行中的工单数')->display(function ($value) {
            return count($value);
        });

        $grid->email_verified_at('已验证邮箱')->display(function ($value) {
            return $value ? '是' : '否';
        });

        $grid->created_at('注册时间');

        // 不在页面显示 `新建` 按钮，因为我们不需要在后台新建用户
        $grid->disableCreateButton();

        $grid->actions(function (Grid\Displayers\Actions $actions) {
            /**@var User $user */
            $user = $actions->row;
            // 不在每一行后面展示查看按钮
            $actions->disableView();
            // 不在每一行后面展示删除按钮
            $actions->disableDelete();
            // 不在每一行后面展示编辑按钮
            $actions->disableEdit();
            $forbiddenDisable = ($user->status === 0 ? 'disabled' : '');
            $freezeDisable = ($user->status === 1 ? 'disabled' : '');
            $actions->append("<a {$forbiddenDisable} class='btn btn-sm btn-primary user-status-opt user-forbidden' data-id='{$user->id}' data-status = '0'>禁止</a>");
            $actions->append("<a {$freezeDisable} class='btn btn-sm btn-primary user-status-opt user-freeze' data-id='{$user->id}' data-status='1' >启用</a>");
            $actions->append("<a class='btn btn-sm btn-primary send-coupon' data-name = '{$user->name}' data-id='{$user->id}' >发优惠券</a>");
        });

        $grid->tools(function (Grid\Tools $tools) {
            // 禁用批量删除按钮
            $tools->batch(function (Grid\Tools\BatchActions $batch) {
                $batch->disableDelete();
            });
        });
        $this->updateUserStatusScript();
        return $grid;
    }

    public function updateStatus($userId, UserRepository $userRepository)
    {
        $user = $userRepository->find($userId);
        if($user){
            $user->status = request('status', !$user->status);
            $user->save();
            return $this->response->array(['message' => '更新成功']);
        }else{
            return $this->response->errorNotFound('没找到对应用户');
        }
    }


    protected function updateUserStatusScript()
    {
        $token = csrf_token();
        $script = <<<SCRIPT
         $.ajaxSetup({headers: {'X-CSRF-TOKEN': '$token'}});
         $(document).on('click', '.user-status-opt', function(){
            let id = $(this).data('id');
            let name = $(this).data('name');
            let status = $(this).data('status');
            let message = status > 0 ? '确定解除禁止此用户' : '确定禁止此用户';
            let alertMessage = name + (status > 0 ? '已经解除禁止': '已经被禁止');
            swal(message).then(() => {
                $.ajax({
                    url: 'users/'+id + '/status/update', 
                    method: 'PUT',
                    data: {'status': status},
                    dataType: 'json',
                    success: (res) => {
                        console.log(res);
                        if(res.status) {
                            swal(alertMessage).then(() => {
                                location.reload();
                            });
                        } 
                    }
                });
             });
         });
SCRIPT;
        Admin::script($script);
    }
}
