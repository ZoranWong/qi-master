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
                    <a href="index.html">首页</a>
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
                            <input type="radio" name="fee" value="全部" title="全部" checked="">
                            <input type="radio" name="fee" value="申请空跑费" title="申请空跑费">
                            <input type="radio" name="fee" value="增加费用" title="增加费用">
                            <input type="radio" name="fee" value="申请退款" title="申请退款">
                            <input type="radio" name="fee" value="申请售后" title="申请售后">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">订单日期</label>
                        <div class="layui-input-block radio-style">
                            <input type="radio" name="date" value="全部" title="全部" checked="">
                            <input type="radio" name="date" value="在线充值" title="近一个月">
                            <input type="radio" name="date" value="订单付款" title="近三个月">
                            <input type="radio" name="date" value="订单退款" title="近六个月">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <div class="layui-inline">
                            <label class="layui-form-label">下单时间</label>
                            <div class="layui-input-inline date-width">
                                <input type="text" class="layui-input" id="selectData" placeholder=" 开始日期-结束日期 ">
                            </div>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">客户信息</label>
                        <div class="layui-input-inline date-width">
                            <input type="text" name="username" lay-verify="required" placeholder="请输入客户姓名或手机号"
                                   autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">订单编号</label>
                        <div class="layui-input-inline date-width">
                            <input type="text" name="ordernum" lay-verify="required" placeholder="请输入订单号"
                                   autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <button class="layui-btn inquire" lay-submit="" lay-filter="">查询</button>
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

</html>
<script>
    layui.use(['form', 'layedit', 'laydate', 'laypage', 'element'], function () {
        var form = layui.form,
            layer = layui.layer,
            layedit = layui.layedit,
            laydate = layui.laydate;
        element = layui.element;
        laypage = layui.laypage
        laydate.render({
            elem: '#selectData',
            range: true
        });
        let first = true;
        laypage.render({
            elem: 'pagination',
            count: {{$count}}, //数据总数
            curr: {{$page}},
            jump: function (obj) {
                console.log(obj);
                if (!first) {
                    location.href = "/orders?{{ $status !== null ? 'status='.$status : '' }}&page=" + obj.curr + '&limit=' + obj.limit;
                }
                first = false;
            }
        });
    })
</script>
