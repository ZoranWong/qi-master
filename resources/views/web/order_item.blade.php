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
            @if ($order->status === \App\Models\Order::ORDER_WAIT_HIRE)
                <a class="order-operation-btn employ-master" href="">雇佣师傅</a>
            @endif
            @if($order->status === \App\Models\Order::ORDER_WAIT_CHECK)
                <a class="order-operation-btn confirm-verify-goods">待验收</a>
            @endif
            {{--@if($order->status === \App\Models\Order::ORDER_WAIT_OFFER)--}}
                {{--<a href="">修改订单</a>--}}
            {{--@endif--}}
            @if($order->status !== \App\Models\Order::ORDER_CHECKED || $order->status !== \App\Models\Order::ORDER_COMPLETED)
                <p class="color-999">取消订单</p>
            @endif
        </div>
    </td>
</tr>
</tbody>
<style>
    .color-ff5000 {
        color: #ff5000;
    }

    .color-22aac8 {
        color: #22aac8;
    }

    .color-999 {
        color: #999;
    }

    .order-operation a {
        display: block;
        color: #666;
    }

    .order-operation .employ-master {
        background-color: #0b8ded;
        border: 1px solid #037dd7;
    }

    .order-operation .order-operation-btn {
        display: block;
        width: 66px;
        margin: 0 auto;
        margin-bottom: 5px;
        line-height: 22px;
        color: #fff;
    }

    .order-operation .confirm-verify-goods {
        background-color: #29bbe6;
    }
</style>
