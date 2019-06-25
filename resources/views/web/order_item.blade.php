<thead>
<tr>
    <th colspan="6">
        <span>订单号：{{$order->orderNo}}</span>
        <span>{{$order->publishedAt}}</span>
        <span>服务商：{{ $order->master->name ?? $order->master->realName }}（{{ $order->master->mobile }}）</span>
    </th>
</tr>
</thead>
<tbody>
@foreach($order->items as $item)
    <tr>
        <td>
            <div class="flex">
                <div class="item-img">
                    <img src="{{$item->product['image']}}">
                </div>
                <div class="item-text">
                    <span>{{$item->classification}}</span>
                    <span>{{$item->category}}{{$item->childCategory ? '-'.$item->childCategory : ''}}</span>
                    <span>数量：{{$item->num}}</span>
                </div>
            </div>
        </td>
        <td>
            <div class="text-center">
                <div>{{ $order->master->name ?? $order->master->realName }}}/{{$order->master->mobile}}</div>
                <div>{{$order->address}}</div>
            </div>
        </td>
        <td>
            <div class="text-center">
                <div>已有<em class="red">{{$order->offerCount}}</em>位师傅报价</div>
                <div>最低价<em class="red">{{$order->minOfferPrice}}</em></div>
            </div>
        </td>
        <td>
            <div>待雇佣</div>
        </td>
        <td>
            <div class="more">
                <a href="order/{{$order->id}}">查看订单</a>
                <a href="">雇佣师傅</a>
                <span>取消订单</span>
            </div>
        </td>
    </tr>
@endforeach
</tbody>
