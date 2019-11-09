<thead class="order-header">
<tr>
    <th colspan="6">
        <span>订单号：{{$order->orderNo}}</span>
        <span>{{$order->publishedAt}}</span>
        <span>服务商：{{ $order->master ? ($order->master->name ?? $order->master->realName.'('.$order->master->mobile.')') : '等待雇佣' }}</span>
    </th>
</tr>
</thead>
<tbody>
<tr>
    <td>
        <div class="flex">
            {{--<div class="item-check-box">--}}
            {{--<input class="check-box" type="checkbox" />--}}
            {{--</div>--}}
            <div class="item-text">
                <span>{{$order->classification}}</span>
                <span style="color: #929292">({{$order->serviceType}})</span>
            </div>
        </div>
    </td>
    <td>
        <div class="text-center">
            <div>{{$order->master ? (($order->master->name ?? $order->master->realName). '/'. $order->master->mobile ) : '等待雇佣' }}</div>
            <div>{{$order->customerAddress}}</div>
        </div>
    </td>
    <td>
        <div class="text-center">
            <div>已有<em class="red">{{$order->offerCount}}</em>位师傅报价</div>
            <div>最低价<em class="red">{{$order->minOfferPrice}}</em></div>
        </div>
    </td>
    <td>
        <div class="{{$order->statusClass}}">{{$order->orderStatus}}</div>
    </td>
    <td>
        <div class="order-operation">
            <a href="orders/{{$order->id}}">查看订单</a>
            @if ($order->status & \App\Models\Order::ORDER_WAIT_HIRE && $order->status < \App\Models\Order::ORDER_EMPLOYED)
                <a class="order-operation-btn employ-master-opt-btn"
                   href="{{route('user.order.detail', ['order' => $order->id])."?service=1"}}">雇佣师傅</a>
            @endif
            @if($order->status & \App\Models\Order::ORDER_EMPLOYED && $order->status < \App\Models\Order::ORDER_PROCEEDING_WAIT_PRE_APPOINT)
                <a class="order-operation-btn order-comment-opt-btn"
                   href="{{route('user.order.detail', ['order' => $order->id])."?service=1"}}">立即支付</a>
            @endif
            @if($order->status & \App\Models\Order::ORDER_WAIT_CHECK && $order->status < \App\Models\Order::ORDER_CHECKED)
                @if(!$order->hadSendCode)
                    <a class="order-operation-btn order-check-opt-btn"
                       data-url="{{api_route('user.order.checked', ['order' => $order->id])}}">待验收</a>
                    <a class="order-operation-btn order-addition-opt-btn"
                       data-url="{{api_route('user.order.addition.fee', ['order' => $order->id])}}">增加费用</a>
                @endif
                @if($order->refundOrders()->count() < config('order.refund_max_time'))
                    <a class="order-operation-btn order-apply-refund-opt-btn" data-total-fee="{{$order->totalAmount}}"
                       data-url="{{api_route('user.order.applyRefund', ['order_id' => $order->id])}}">申请退款</a>
                @elseif($order->refundOrders()->where('status', \App\Models\RefundOrder::APPLY_STATUS_WAIT)->count() > 0)
                    <span>退款中</span>
                @elseif($order->refundOrders()->where('status',\App\Models\RefundOrder::APPLY_STATUS_DONE)->count() > 0)
                    <span>已退款</span>
                @elseif($order->refundOrders()->where('status', \App\Models\RefundOrder::APPLY_STATUS_REFUSED)->count() >= config('order.refund_max_time'))
                    <a class="order-operation-btn refund-need-opt-btn"
                       data-url="{{api_route('user.refunds.need_customer', ['refundOrder' => $order->refundOrders[0]->id])}}">中介介入</a>
                @endif
            @endif
            @if($order->status & \App\Models\Order::ORDER_CHECKED && $order->status < \App\Models\Order::ORDER_COMPLETED)
                <a class="order-operation-btn order-comment-opt-btn"
                   href="{{route('user.order.comment.view', ['order' => $order->id])}}">评价</a>
            @endif
            @if(!($order->status & \App\Models\Order::ORDER_CHECKED || $order->status & \App\Models\Order::ORDER_COMPLETED || $order->status & \App\Models\Order::ORDER_CLOSED))
                <a class="color-999 order-cancel-opt-btn"
                   data-url="{{api_route('user.order.cancel', ['order' => $order->id])}}">取消订单</a>
            @endif
        </div>
    </td>
</tr>
</tbody>
