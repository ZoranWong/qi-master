<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title></title>
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
                    <a href="order.html" class="">全部订单 ›</a>
                </div>
                <ul class="content clearfix">
                    <li>
                        <a href="">
                            <i></i> <span>待报价</span>
                            <div>0</div>
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <i></i> <span>待雇佣</span>
                            <div>0</div>
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <i></i> <span>待支付</span>
                            <div>0</div>
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <i></i> <span>待确认验收</span>
                            <div>0</div>
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <i></i> <span>待评价</span>
                            <div>0</div>
                        </a>
                    </li>
                </ul>

                <div class="layui-form">
                    <table class="layui-table">
                        <thead>
                        <tr>
                            <th colspan="6">
                                <span>订单号：P10434789148</span>
                                <span>2019-01-17 13:34:04</span>
                                <span>服务商：黄锋（18260098365）</span>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                <div class="flex">
                                    <div class="item-img">
                                        <img src="/web/image/product.jpg">
                                    </div>
                                    <div class="item-text">
                                        <span>衣柜</span>
                                        <span>两门小衣柜</span>
                                        <span>数量：1</span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="text-center">
                                    <div>周金梅/13864666439</div>
                                    <div>山东省潍坊市寒亭区大家洼街道八里村小5号楼2单元302</div>
                                </div>
                            </td>
                            <td>
                                <div class="text-center">
                                    <div>已有<em class="red">1</em>位师傅报价</div>
                                    <div>最低价<em class="red">159.00</em></div>
                                </div>
                            </td>
                            <td>
                                <div>待雇佣</div>
                            </td>
                            <td>
                                <div class="more">
                                    <a href="orderinfo.html">查看订单</a>
                                    <a href="">雇佣师傅</a>
                                    <span>取消订单</span>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>

</div>

<!--content--end-->

</body>

</html>
