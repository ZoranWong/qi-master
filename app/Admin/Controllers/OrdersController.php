<?php

namespace App\Admin\Controllers;

use App\Exceptions\InternalException;
use App\Exceptions\InvalidRequestException;
use App\Http\Requests\Admin\HandleRefundRequest;
use App\Models\Order;
use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use App\Models\PaymentOrder;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Widgets\Table;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    use HasResourceActions;

    public function index(Content $content)
    {
        return $content
            ->header('订单列表')
            ->body($this->grid());
    }

    public function show(Order $order, Content $content)
    {
//        $order->items[0]->installFeeFormat;
        return $content
            ->header('查看订单')
            // body 方法可以接受 Laravel 的视图作为参数
            ->body(view('admin.orders.show', [
                'order' => $order,
                'orderItems' => $order->items,
                'offerOrders' => $order->offerOrders,
                'paymentOrders' => $order->payments,
                'refundOrders' => $order->refundOrders
            ]));
    }

    protected function grid()
    {
        $grid = new Grid(new Order);

        // 只展示已支付的订单，并且默认按支付时间倒序排序

        $grid->column('order_no', '编号')->expand(function (Order $order) {
            $items = $order->items->map(function (OrderItem $item) {
                return [$item->id, $item->product['title'], "<img width='36' src='{$item->product['image']}'/>", $item->master->name, ];
            });

            return $items->count() > 0 ? (new Table(['ID', '安装（服务）产品',  '产品图片', '接单师傅'], $items->toArray())) : '';
        });
        $grid->column('user.name', '用户');
        $grid->column('masters', '接单师傅(人数)')->display(function ($value) {
            return !empty($value) ? count($value).'人' : '--等待师傅接单--';
        });
        $grid->column('status', '状态')->display(function ($value) {
            /**
             * @var Order $order
             * */
            $order = $this;
            if ($order->refundStatus === 0) {
                return $order->statusDesc;
            } else {
                return Order::STATUS_REFUND[$order->refundStatus];
            }

        });

        $grid->column('type', '类型')->display(function (int $value) {
            return Order::ORDER_TYPE[$value];
        });
        $grid->column('total_amount', '订单总金额')->display(function ($value) {
            return number_format($value, 2);
        });
        $grid->disableCreateButton();
        $grid->actions(function (Grid\Displayers\Actions $actions) {
            $actions->disableDelete();
            $actions->disableEdit();
        });
        return $grid;
    }
}
