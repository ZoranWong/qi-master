<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="/web/plugin/layui/css/layui.css"/>
    <link rel="stylesheet" href="/web/css/common.css"/>
    <link rel="stylesheet" href="/web/css/styles.css"/>
    @stack('styles')
    <script type="text/javascript" src="/web/js/jquery-3.3.1.js"></script>
    <script type="text/javascript" src="/web/plugin/layui/layui.js"></script>
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
                    <a href="/">首页</a>
                </li>
            </ul>
        </div>
        @include('web.menu')
        <div class="right-content">
            <div class="index-user clearfix">
                <div class="user">
                    <div class="head-pic">
                        @if($user->avatarUrl)
                            <img src="{{$user->avatarUrl}}">
                        @endif
                    </div>
                    <div class="name">
                        <a href="/profile">{{$user->userName}}</a>
                    </div>
                </div>
                <div class="wallet">
                    <h4>我的钱包</h4>
                    <div class="recharge">
                        <div class="money">{{$user->balanceFormat}}</div>
                        <div class="text">余额(元)</div>
                        <a href="recharge" class="btn">充值</a>
                    </div>
                </div>
            </div>

            <div class="index-table order">
                <div class="title">
                    <h4>我的订单</h4>
                    <a href="/orders" class="">全部订单 ›</a>
                </div>
                <ul class="content clearfix">
                    <li>
                        <a href="/orders?status={{\App\Models\Order::ORDER_WAIT_OFFER}}">
                            <i></i> <span>待报价</span>
                            <div>{{$user->waitOfferCount}}</div>
                        </a>
                    </li>
                    <li>
                        <a href="/orders?status={{\App\Models\Order::ORDER_WAIT_HIRE}}">
                            <i></i> <span>待雇佣</span>
                            <div>{{$user->waitEmployeeCount}}</div>
                        </a>
                    </li>
                    <li>
                        <a href="/orders?status={{\App\Models\Order::ORDER_EMPLOYED}}">
                            <i></i> <span>待支付</span>
                            <div>{{$user->waitPayCount}}</div>
                        </a>
                    </li>
                    <li>
                        <a href="/orders?status={{\App\Models\Order::ORDER_WAIT_CHECK}}">
                            <i></i> <span>待确认验收</span>
                            <div>{{$user->waitCheckCount}}</div>
                        </a>
                    </li>
                    <li>
                        <a href="/orders">
                            <i></i> <span>待评价</span>
                            <div>{{$user->waitCommentCount}}</div>
                        </a>
                    </li>
                </ul>

                <div class="layui-form">
                    <table class="layui-table">
                        @foreach($orders as $order)
                            @include('web.order_item', ['order' => $order])
                        @endforeach
                    </table>
                </div>

            </div>
        </div>

    </div>

</div>

<!--content--end-->

</body>
<style>
    .order-item-table{
        margin-bottom: 32px;
    }
</style>

</html>
