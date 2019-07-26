<?php

namespace App\Http\Controllers;

use App\Events\OrderReviewed;
use App\Exceptions\CouponCodeUnavailableException;
use App\Exceptions\InvalidRequestException;
use App\Http\Requests\ApplyRefundRequest;
use App\Http\Requests\OrderRequest;
use App\Http\Requests\SendReviewRequest;
use App\Models\Classification;
use App\Models\CouponCode;
use App\Models\PaymentOrder;
use App\Models\Region;
use App\Models\User;
use App\Models\UserAddress;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Services\OrderService;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;

class OrdersController extends Controller
{
    public function store(OrderRequest $request, OrderService $orderService)
    {
        $user = $request->user();
        $address = UserAddress::find($request->input('address_id'));
        $coupon = null;

        // 如果用户提交了优惠码
        if ($code = $request->input('coupon_code')) {
            $coupon = CouponCode::where('code', $code)->first();
            if (!$coupon) {
                throw new CouponCodeUnavailableException('优惠券不存在');
            }
        }
        // 参数中加入 $coupon 变量
        return $orderService->store($user, $address, $request->input('remark'), $request->input('items'), $coupon);
    }

    public function index(Request $request)
    {
        $view = null;
        /**@var User $user**/
        $user = auth()->user();
        if (isMobile()) {
            $view = view('h5.order');
        } else {
            $view = view('web.order');
        }
        $limit = $request->input('limit', 15);
        $offset = ($request->input('page', 1) - 1) * $limit;

        $query = $user->orders();
        if($request->input('status', null)) {
            $query->where('status', $request->input('status'));
        }
        if(($tag = $request->input('tag', null))) {
            switch ($tag) {
                case 'ADDITION_FEE':

                    $query->whereHas('payments', function ($query) {
                        $query->where('type', PaymentOrder::TYPE_ADDITION_ORDER)
                            ->where('status', PaymentOrder::STATUS_PAID);
                    });
                    break;
                case 'REFUND':
                    $query->whereHas('refundOrders');
                    break;
                case 'AFTER_SALE':
                    $query->whereHas('complaints');
                    break;
            }

        }

        if(($date = $request->input('date', null))) {
            $now = \Illuminate\Support\Carbon::now();
            $start = $now->copy()->subMonth($date);
            $query->where('created_at', '>=', $start->format('Y-m-d H:i:s'))
                ->where('created_at', '<', $now->format('Y-m-d H:i:s'));
        }
        $count = $query->count();
//        dd(DB::getQueryLog(), $count);
        $orders = $query
            ->with(['offerOrders'])
            ->offset($offset)
            ->limit($limit)
            ->orderBy('created_at', 'desc')
            ->get();
        $view->with([
            'selected' => 'orders',
            'currentMenu' => 'orders',
            'orders' => $orders,
            'count' => $count,
            'page' => $request->input('page', 1),
            'limit' => $limit,
            'status' => $request->input('status', null),
            'tag' => $request->input('tag', null),
            'date' => $request->input('date', null),
            'orderDate' => $request->input('order_date', null),
            'orderNo' => $request->input('order_no', null),
            'searchField' => $request->input('search_field', null)
        ]);

        return $view;
    }

    public function show($id, Request $request)
    {
        $order = Order::with(['offerOrders', 'refundOrders.master', 'classification'])
            ->find($id);
        $view = null;
        if (isMobile()) {
            $view = view('h5.orderDetail');
        } else {
            $view = view('web.orderinfo')->with([
                'selected' => 'orders',
                'currentMenu' => 'orders'
            ]);
        }

        $view->with('order', $order);
        return $view;
    }

    public function received(Order $order, Request $request)
    {
        // 校验权限
        $this->authorize('own', $order);

        // 判断订单的发货状态是否为已发货
        if ($order->ship_status !== Order::SHIP_STATUS_DELIVERED) {
            throw new InvalidRequestException('发货状态不正确');
        }

        // 更新发货状态为已收到
        $order->update(['ship_status' => Order::SHIP_STATUS_RECEIVED]);

        // 返回订单信息
        return $order;
    }

    public function review(Order $order)
    {
        // 校验权限
        $this->authorize('own', $order);
        // 判断是否已经支付
        if (!$order->paid_at) {
            throw new InvalidRequestException('该订单未支付，不可评价');
        }
        // 使用 load 方法加载关联数据，避免 N + 1 性能问题
        return view('orders.review', ['order' => $order->load(['items.productSku', 'items.product'])]);
    }

    public function sendReview(Order $order, SendReviewRequest $request)
    {
        // 校验权限
        $this->authorize('own', $order);
        if (!$order->paid_at) {
            throw new InvalidRequestException('该订单未支付，不可评价');
        }
        // 判断是否已经评价
        if ($order->reviewed) {
            throw new InvalidRequestException('该订单已评价，不可重复提交');
        }
        $reviews = $request->input('reviews');
        // 开启事务
        \DB::transaction(function () use ($reviews, $order) {
            // 遍历用户提交的数据
            foreach ($reviews as $review) {
                $orderItem = $order->items()->find($review['id']);
                // 保存评分和评价
                $orderItem->update([
                    'rating' => $review['rating'],
                    'review' => $review['review'],
                    'reviewed_at' => Carbon::now(),
                ]);
            }
            // 将订单标记为已评价
            $order->update(['reviewed' => true]);
            event(new OrderReviewed($order));
        });

        return redirect()->back();
    }

    public function applyRefund(Order $order, ApplyRefundRequest $request)
    {
        // 校验订单是否属于当前用户
        $this->authorize('own', $order);
        // 判断订单是否已付款
        if (!$order->paid_at) {
            throw new InvalidRequestException('该订单未支付，不可退款');
        }
        // 判断订单退款状态是否正确
        if ($order->refund_status !== Order::REFUND_STATUS_PENDING) {
            throw new InvalidRequestException('该订单已经申请过退款，请勿重复申请');
        }
        // 将用户输入的退款理由放到订单的 extra 字段中
        $extra = $order->extra ?: [];
        $extra['refund_reason'] = $request->input('reason');
        // 将订单退款状态改为已申请退款
        $order->update([
            'refund_status' => Order::REFUND_STATUS_APPLIED,
            'extra' => $extra,
        ]);

        return $order;
    }

    public function publish($step = 'publish')
    {
        $view = null;
        if (isMobile()) {
            $view = view('h5.'.$step);
        } else {
            $view = view('web.publish')->with([
                'selected' => 'publish',
                'currentMenu' => 'publish'
            ]);
        }
        $user = auth()->user();
        $token = JWTAuth::fromUser($user);
        $classifications = Classification::with(['serviceTypes', 'topCategories.children',
            'topCategories.properties', 'topCategories.children.properties',
            'topCategories.requirements', 'topCategories.children.requirements'])
            ->get();
        $provinces = Region::getProvinces();
        return $view->with([
            'classifications' => $classifications,
            'productsUrl' => api_route('user.products.list')."?token={$token}",
            'masterSearchUrl' => api_route('user.order.search_master')."?token={$token}",
            'productUpload' => api_route('user.upload.product'),
            'provinces' => $provinces,
            'publishOrder' => api_route('user.publish')."?token={$token}"
        ]);
    }
}
