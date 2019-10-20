<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>会员中心-我的账户</title>
    <link rel="stylesheet" href="/web/plugin/layui/css/layui.css"/>
    <link rel="stylesheet" href="/web/css/common.css"/>
    <link rel="stylesheet" href="/web/css/styles.css"/>
    <script type="text/javascript" src="/web/js/jquery-3.3.1.js"></script>
    <script type="text/javascript" src="/web/plugin/layui/layui.js"></script>
    <script type="text/javascript" src="/web/js/common.js"></script>
</head>

<body>
<!--header-->
@include('web.header')

<!--header end-->

<!--content-->
<div class="distance">
    <div class="max-width clearfix">
        <div class="crumbs">
            <ul class="clearfix">
                <li>您的位置：</li>
                <li>
                    <a href="{{route('home')}}">首页</a>
                </li>
                <li>
                    <a href=""></a> <span class="separator">&gt;</span>
                </li>
                <li>
                    <a href="{{route('user.orders')}}">订单管理</a> <span class="separator">&gt;</span>
                </li>
                <li>订单详情</li>
            </ul>
        </div>
        <div class="order-info">
            <div class="info-title">
                <h2>订单号：{{$order->orderNo}}</h2>
                {{--<a href="" class="">取消订单</a>--}}
            </div>

            <div class="info-status">
                <div class="left">
                    <p class="status-intro" style="margin-top: 130px;">
                        已有 <b>{{$order->offerOrders->count()}}</b> 位师傅参与报价
                        {{--<a href="javascript:void(0)">查看</a>--}}
                        {{--<a href="javascript:void(0)">刷新</a>--}}
                    </p>
                    {{--<div class="time">订单有效倒计时：</div>--}}
                </div>
                <div class="right">
                    <div style="overflow: hidden; margin-bottom: 50px;"><i
                            class="status fl wait">{{$order->orderStatus}}</i>
                        <div class="date fr">
                            订单发布时间：{{$order->publishedAt}}
                        </div>
                    </div>
                    <div class="status-bar">
                        <span class="step1 on">一键下单</span>
                        <span class="separator on"></span>
                        <span
                            class="step2 {{$order->status & \App\Models\Order::ORDER_WAIT_HIRE ? 'on' : ''}}">师傅报价</span>
                        <span
                            class="separator {{$order->status & \App\Models\Order::ORDER_WAIT_HIRE ? 'on' : ''}}"></span>
                        <span
                            class="step3 {{$order->status & \App\Models\Order::ORDER_EMPLOYED ? 'on' : ''}}">雇佣师傅</span>
                        <span
                            class="separator {{$order->status & \App\Models\Order::ORDER_EMPLOYED ? 'on' : ''}}"></span>
                        <span
                            class="step4 {{$order->status & \App\Models\Order::ORDER_PROCEEDING_WAIT_PRE_APPOINT ? 'on' : ''}}">支付费用</span>
                        <span
                            class="separator {{$order->status & \App\Models\Order::ORDER_PROCEEDING_WAIT_PRE_APPOINT ? 'on' : ''}}"></span>
                        <span
                            class="step5 {{$order->status & \App\Models\Order::ORDER_PROCEEDING_APPOINTED ? 'on' : ''}}">师傅服务</span>
                        <span
                            class="separator {{$order->status & \App\Models\Order::ORDER_PROCEEDING_APPOINTED ? 'on' : ''}}"></span>
                        <span
                            class="step6 {{$order->status & \App\Models\Order::ORDER_CHECKED ? 'on' : ''}}">验收完工</span>
                    </div>
                </div>
            </div>

            <div class="info-main">
                <ul class="info-tab">
                    <li class="{{request('service', false) ? '' : 'selected'}} order-info-tab">订单信息</li>
                    <li class="{{request('service', false) ? 'selected' : ''}}  master-service-tab">服务信息</li>
                </ul>
                <div class="tab-content">
                    <div class="tab-item {{request('service', false)? 'hide' : ''}}">
                        <dl class="tab-info">
                            <dt>服务需求</dt>
                            <dd>服务类型：（{{$order->classification ? $order->classification->name : ''}}）</dd>
                            <dd>期望服务日期：{{$order->hopeServiceAt}}</dd>
                            <dd>订单备注：{{$order->remark ?? '-'}}</dd>
                            <dt>客户地址</dt>
                            <dd>客户姓名：{{$order->customerInfo ? $order->customerInfo['name'] : ""}}</dd>
                            <dd>联系电话：{{$order->customerInfo ? $order->customerInfo['phone'] : ''}}</dd>
                            <dd>客户地址： {{$order->customerInfo ? $order->customerInfo['address'] : ''}}</dd>
                            <dt>联系人信息</dt>
                            <dd>下单人：{{$order->contactUserName}} / {{$order->contactUserPhone}}</dd>
                            <dt style="border-bottom: none;">商品信息</dt>
                            <dd>
                                <table class="layui-table">
                                    <thead>
                                    <tr>
                                        <th style="width: 140px;">商品图片</th>
                                        <th style="width: 235px;">商品型号/类别</th>
                                        <th style="width: 60px;">商品数量</th>
                                        <th>特殊要求</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($order->products as $product)
                                        <tr>
                                            <td>
                                                <div class="item-img">
                                                    <img src="{{$product['image']}}">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="text-center">
                                                    <div>{{$product['title']}}</div>
                                                    <div>（{{isset($product['category_name']) ? $product['category_name'].
                                                    (isset($product['child_category_name']) ? $product['child_category_name'] : '') : ''}}
                                                        ）
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{isset($product['num']) ? isset($product['num']) : 1}}个</td>
                                            <td>
                                                {{isset($product['remark']) ? $product['remark'] : ''}}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </dd>
                            <dt>订单时间</dt>
                            <dd>创建订单：{{$order->publishedAt}}</dd>
                        </dl>
                    </div>
                    <div class="tab-item {{request('service', false)? '' : 'hide'}}">
                        <ul class="offer-list">
                            @foreach($order->offerOrders as $offerOrder)
                                <li>
                                    <a href="">
                                        <div class="img-box">
                                            <img src="{{$offerOrder->master->avatar}}">
                                        </div>
                                    </a>
                                    <div class="intro">
                                        <div class="name"><span class="fl">{{$offerOrder->master->name}}</span>
                                        </div>
                                        <p>
                                            <span>
                                                {{$offerOrder->master->serviceByGep}}
                                            </span>
                                        </p>
                                        <p></p>
                                        <div class="area"><span class="icon">服务范围</span>
                                            {!!$offerOrder->master->serviceArea!!}
                                        </div>
                                    </div>
                                    <div class="data">
                                        <div class="rate">
                                            评分：<b class="f-yellow">{{$offerOrder->master->score}}分</b>
                                        </div>
                                        <div>服务 {{$offerOrder->master->serviceOrderCount}} 单 / 与我合作 {{$offerOrder->master->serviceWithMeOrderCount}} 次</div>
                                        <div>好评率{{$offerOrder->master->goodCommentRate}}</div>
                                    </div>
                                    <div class="offer">
                                        <div>
                                            <b>¥{{$offerOrder->quotePriceFormat}}</b>
                                            @if($offerOrder->status === \App\Models\OfferOrder::STATUS_WAIT && ($order->status & \App\Models\Order::ORDER_WAIT_HIRE
                                            && $order->status < \App\Models\Order::ORDER_EMPLOYED))
                                                <button class="employ-btn"
                                                        data-url="{{api_route('user.order.hire_master', ['order' => $order->id]).'?token='.$token}}"
                                                        data-id="{{$offerOrder->id}}">雇佣并支付
                                                </button>
                                            @elseif($offerOrder->status === \App\Models\OfferOrder::STATUS_HIRED &&
                                            ($order->status & \App\Models\Order::ORDER_EMPLOYED && $order->status < \App\Models\Order::ORDER_PROCEEDING_WAIT_PRE_APPOINT))
                                                <button class="pay-btn" data-offer-id = "{!!$offerOrder->id!!}">去支付</button>
                                            @endif
                                            <div class="phone">{{$offerOrder->master->mobile}}</div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div id="payTypePopup" style="display: none;">
        <form class="layui-form">
            <div class="layui-form-item">
                <ul>
                    <li><input type="radio" name="pay_type" value="WechatPay" title="微信支付" checked></li>
                    <li><input type="radio" name="pay_type" value="AliPay" title="支付宝支付"></li>
                    <li><input type="radio" name="pay_type" value="BalancePay" title="余额支付"></li>
                </ul>
            </div>
        </form>
    </div>
</div>

<!--content--end-->

</body>

</html>
<script>
    const currentOrderData = {!! $order !!};
    $(function () {
        layui.use(['layer', 'form'], function () {
            let form = layui.form;
            form.render();
            function payLayer(id = 1) {
                layer.open({
                    title: '选择支付方式',
                    content: $('#payTypePopup').html(),
                    success(data) {
                        form.render();
                    },
                    yes(data) {
                        let payType = $('div#layui-layer1.layui-layer.layui-layer-dialog input:radio:checked[name="pay_type"]').val();
                        let host = location.origin;
                        let url = "";
                        switch (payType) {
                            case 'WechatPay':
                                url = `${host}/wx/pay/${id}`;
                                layer.closeAll();
                                window.open(url)
                                break;
                            case 'AliPay':
                                url = `${host}/ali/pay/${id}`;
                                layer.closeAll();
                                window.open(url)
                                break;
                            case 'BalancePay':
                                url = `${host}/balance/pay/${id}?token=` + "{{$token}}";
                                $.get(url);
                                break;
                        }
                    }
                });

            }

            $('.pay-btn').click(function () {
                let id = $(this).data('offer-id');
                payLayer(id);
            });
            $('.employ-btn').click(function () {
                let url = $(this).data('url');
                let id = $(this).data('id');
                layer.confirm('是否确认雇佣此人为您服务？', {
                    btn: ['确认', '取消'] //按钮
                }, function () {
                    $.post({
                        url: url,
                        data: {'offer_order_id': id},
                        success(data) {
                            payLayer();
                        },
                        fail() {

                        }
                    });
                }, function () {

                });
            });
            $(".info-tab li").click(function () {
                let i = $(this).index()
                console.log(i)
                $(this).addClass('selected').siblings().removeClass('selected');
                $('.tab-content .tab-item').eq(i).addClass('show').siblings().removeClass('show').addClass('hide');
            });
        });
    })
</script>
