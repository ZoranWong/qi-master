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
    <style type="text/css">
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

        .order-operation .order-operation-btn {
            background-color: #29bbe6;
        }

        .order-operation .order-operation-btn:hover {
            cursor: pointer;
        }
    </style>
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
                <li>
                    <a href=""></a> <span class="separator">&gt;</span>
                </li>

                <li>订单管理</li>
            </ul>
        </div>
        @include('web.menu')
        <div class="right-content">
            <h2>订单中心</h2>
            <div class="layui-tab">
                <ul class="layui-tab-title">
                    <li class="{!! !$status ? 'layui-this' : ''!!}">
                        <a href="/orders">全部</a>
                    </li>
                    <li class="{!! $status == \App\Models\Order::ORDER_EMPLOYED ? 'layui-this' : ''!!}">
                        <a href="/orders?status={{\App\Models\Order::ORDER_EMPLOYED}}">待付款</a>
                    </li>
                    <li class="{!! $status == \App\Models\Order::ORDER_WAIT_HIRE ? 'layui-this' : ''!!}">
                        <a href="/orders?status={{\App\Models\Order::ORDER_WAIT_HIRE}}">待雇佣</a>
                    </li>
                    <li class="{!! $status == \App\Models\Order::ORDER_WAIT_CHECK ? 'layui-this' : ''!!}">
                        <a href="/orders?status={{\App\Models\Order::ORDER_WAIT_CHECK}}">待验收</a>
                    </li>
                    <li class="{!! $status == \App\Models\Order::ORDER_CHECKED ? 'layui-this' : ''!!}">
                        <a href="/orders?status={{\App\Models\Order::ORDER_CHECKED}}">待评价</a>
                    </li>
                </ul>
                <div class="layui-form float-none">
                    <div class="layui-form-item">
                        <label class="layui-form-label">订单标记</label>
                        <div class="layui-input-block radio-style">
                            <input type="radio" name="tag" value="" title="全部" {{$tag === null ? 'checked' : ''}}>
                            {{--<input type="radio" name="fee" value="" title="申请空跑费">--}}
                            <input type="radio" name="tag" value="ADDITION_FEE"
                                   title="增加费用" {{$tag === 'ADDITION_FEE' ? 'checked' : ''}}>
                            <input type="radio" name="tag" value="REFUND"
                                   title="申请退款" {{$tag === 'REFUND' ? 'checked' : ''}}>
                            <input type="radio" name="tag" value="AFTER_SALE"
                                   title="申请售后" {{$tag === 'AFTER_SALE' ? 'checked' : ''}}>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">订单日期</label>
                        <div class="layui-input-block radio-style">
                            <input type="radio" name="date" value="" title="全部" {{$date === null ? 'checked' : ''}}>
                            <input type="radio" name="date" value="1" title="近一个月" {{$date == 1 ? 'checked' : ''}}>
                            <input type="radio" name="date" value="3" title="近三个月" {{$date == 3 ? 'checked' : ''}}>
                            <input type="radio" name="date" value="6" title="近六个月" {{$date == 6 ? 'checked' : ''}}>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <div class="layui-inline">
                            <label class="layui-form-label">下单时间</label>
                            <div class="layui-input-inline date-width">
                                <input name="order_date" type="text" class="layui-input" id="selectData"
                                       placeholder=" 开始日期-结束日期 " value="{{$orderDate}}">
                            </div>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">客户信息</label>
                        <div class="layui-input-inline date-width">
                            <input type="text" name="search_field" placeholder="请输入客户姓名或手机号"
                                   autocomplete="off" class="layui-input" value="{{$searchField}}">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">订单编号</label>
                        <div class="layui-input-inline date-width">
                            <input type="text" name="order_no" placeholder="请输入订单号"
                                   autocomplete="off" class="layui-input" value="{{$orderNo}}">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <button class="layui-btn inquire" lay-submit="" lay-filter="search">查询</button>
                    </div>
                </div>
                <div class="layui-tab-content order">
                    <div class="layui-tab-item {{$status ? '' : 'layui-show'}}">
                        <div class="layui-form">
                            <table class="layui-table">
                                @foreach($orders as $order)
                                    @include('web.order_item', ['order' => $order])
                                @endforeach
                            </table>
                        </div>
                    </div>

                    <div class="layui-tab-item {{$status == \App\Models\Order::ORDER_EMPLOYED ? 'layui-show' : ''}}">
                        <div class="layui-form">
                            <table class="layui-table">
                                @foreach($orders as $order)
                                    @include('web.order_item', ['order' => $order])
                                @endforeach
                            </table>
                        </div>
                    </div>

                    <div class="layui-tab-item {{$status == \App\Models\Order::ORDER_WAIT_HIRE ? 'layui-show' : ''}}">
                        <div class="layui-form">
                            <table class="layui-table">
                                @foreach($orders as $order)
                                    @include('web.order_item', ['order' => $order])
                                @endforeach
                            </table>
                        </div>
                    </div>
                    <!--待验收-->
                    <div class="layui-tab-item {{$status == \App\Models\Order::ORDER_WAIT_CHECK ? 'layui-show' : ''}}">
                        <div class="layui-form">
                            <table class="layui-table">
                                @foreach($orders as $order)
                                    @include('web.order_item', ['order' => $order])
                                @endforeach
                            </table>
                        </div>
                    </div>
                    <!--待验收end-->

                    <!--待评价-->
                    <div class="layui-tab-item {{$status == \App\Models\Order::ORDER_CHECKED ? 'layui-show' : ''}}">
                        <div class="layui-form">
                            <table class="layui-table">
                                @foreach($orders as $order)
                                    @include('web.order_item', ['order' => $order])
                                @endforeach
                            </table>
                        </div>
                    </div>
                    <!--待评价end-->
                    <div id="pagination"></div>
                </div>

            </div>

        </div>

    </div>

</div>

<!--content--end-->

</body>
@include('web.pager')
@include('web.orderListScript')
</html>

