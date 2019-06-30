<div class="common-wrap">
    <div>
        <ul>
            <li><span>服务类型：{{$comment->serviceType}}</span>
                <span>订单：<a href="" class="f-yellow">{{$comment->order->orderNo}}</a></span>
                <span>服务价格：{{$comment->serviceQuotePrice}}元</span><span
                    class="fr"><span style="display: inline-block; margin: 0px; padding: 0px;">{{$comment->commentAt}}</span></span>
            </li>
            <li>
                <span>好评</span>
                <span> | 质量（{{$comment->rates['quality']}}）</span>
                <span>态度（{{$comment->rates['attitude']}}）</span>
                <span>速度（{{$comment->rates['speed']}}）</span></li>
            <li><span>评价：</span><span>{{$comment->content}}</span></li>
        </ul>
    </div>
</div>
