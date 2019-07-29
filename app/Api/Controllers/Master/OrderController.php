<?php

namespace App\Api\Controllers\Master;

use App\Api\Controller;
use App\Models\Order;
use App\Repositories\OrderRepository;
use App\Transformers\Master\NewOrderDetailTransformer;
use App\Transformers\Master\NewOrderTransformer;
use App\Transformers\OrderDetailTransformer;
use App\Transformers\OrderTransformer;
use Dingo\Api\Http\Response;
use Illuminate\Support\Carbon;

class OrderController extends Controller
{
    protected $repository;

    public function __construct(OrderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $paginator = $this->repository->getList();

        return $this->response->paginator($paginator, new OrderTransformer);
    }

    public function detail(Order $order)
    {
        if (auth()->id() !== $order->masterId) {
            $this->response->errorForbidden('您无权查看不属于您的订单详情');
        }

        $order = $this->repository->with(['comment', 'classification', 'serviceType'])->find($order->id);

        return $this->response->item($order, new OrderDetailTransformer);
    }

    /**
     * 新单列表
     * @return Response
     */
    public function newOrders()
    {
        $paginator = $this->repository->getNewOrderList();

        return $this->response->paginator($paginator, new NewOrderTransformer);
    }

    /**
     * 新单详情
     * @param Order $order
     * @return Response
     */
    public function newOrderDetail(Order $order)
    {
        $order = $this->repository->with(['comment', 'classification', 'serviceType'])->find($order->id);

        return $this->response->item($order, new NewOrderDetailTransformer);
    }


    public function reserve(Order $order)
    {
        $reservationDate = request('reservation_date');
        if ($order->status & Order::ORDER_PROCEEDING_WAIT_PRE_APPOINT) {
            $order->status |= Order::ORDER_PROCEEDING_APPOINTED;
            $order->reservationDate = Carbon::createFromFormat('Y-m-d H:i:s', $reservationDate.' 23:59:59');
            if($order->save()) {
                return $this->response->array([
                    'message' => '预约成功'
                ]);
            }
        }
        return $this->response->errorInternal('无法预约此订单！');
    }

    public function checkIn(Order $order)
    {
        if($order->status & Order::ORDER_PROCEEDING_APPOINTED || $order->status & Order::ORDER_PROCEEDING_PRODUCT_RECEIVED) {
            $order->status |= Order::ORDER_PROCEEDING_SIGNED;
            $order->checkInDate = Carbon::now();
            if($order->save()){
                return $this->response->array([
                    'message' => '签到成功'
                ]);
            }
        }

        return $this->response->errorInternal('非预约订单无法签到！');
    }

    public function pickUpProduct(Order $order)
    {
        if($order->status & Order::ORDER_PROCEEDING_APPOINTED) {
            $order->status |= Order::ORDER_PROCEEDING_PRODUCT_RECEIVED;
            $order->pickUpDate = Carbon::now();
            if($order->save()){
                return $this->response->array([
                    'message' => '提货成功'
                ]);
            }
        }

        return $this->response->errorInternal('非预约订单无法提货！');
    }

    public function reserveSecondary(Order $order)
    {
        if($order->status & Order::ORDER_PROCEEDING_SIGNED) {
            $order->needSecondaryService = true;
            $order->secondaryServiceDate = Carbon::now();
            if($order->save()){
                return $this->response->array([
                    'message' => '已经预约二次上门'
                ]);
            }
        }

        return $this->response->errorInternal('操作失败！');
    }

    public function requestCheck(Order $order)
    {
        if ($order->status & Order::ORDER_PROCEEDING_SIGNED) {
            $order->status |= Order::ORDER_WAIT_CHECK;
            $order->reqCheckDate = Carbon::now();
            if($order->save()){
                return $this->response->array([
                    'message' => '提货成功'
                ]);
            }
        }
        return $this->response->errorInternal('操作失败！');
    }

    public function completedOrder(Order $order)
    {
        if($order->orderCheckedCode !== request('code')){
            return $this->response->errorInternal('验收码错误！');
        }
        if ($order->status & Order::ORDER_WAIT_CHECK) {
            $order->status |= Order::ORDER_CHECKED;
            $order->orderCheckedDate= Carbon::now();
            if($order->save()){
                return $this->response->array([
                    'message' => '订单完成'
                ]);
            }
        }
        return $this->response->errorInternal('操作失败！');
    }

}
