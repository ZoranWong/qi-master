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
                <h2>订单号：S2294752457027096576</h2>
                <a href="" class="">取消订单</a>
            </div>

            <div class="info-status">
                <div class="left">
                    <p class="status-intro" style="margin-top: 130px;">
                        已通知 <b>{{$order->offerOrders->count()}}</b> 位师傅
                        <a href="javascript:void(0)">查看</a>
                        <a href="javascript:void(0)">刷新</a>
                    </p>
                    <div class="time">订单有效倒计时：</div>
                </div>
                <div class="right">
                    <div style="overflow: hidden; margin-bottom: 50px;"><i class="status fl wait">等待报价</i>
                        <div class="date fr">
                            订单发布时间：{{$order->publishedAt}}
                        </div>
                    </div>
                    <div class="status-bar">
                        <span class="step1 on">一键下单</span>
                        <span class="separator on"></span>
                        <span class="step2 on">师傅报价</span>
                        <span class="separator"></span>
                        <span class="step3">雇佣师傅</span>
                        <span class="separator separator"></span>
                        <span class="step4">支付费用</span>
                        <span class="separator"></span>
                        <span class="step5">师傅服务</span>
                        <span class="separator"></span>
                        <span class="step6">验收完工</span>
                    </div>
                </div>
            </div>

            <div class="info-main">
                <ul class="info-tab">
                    <li class="selected">订单信息</li>
                    <li>服务信息</li>
                </ul>
                <div class="tab-content">
                    <div class="tab-item">
                        <dl class="tab-info">
                            <dt>服务需求</dt>
                            <dd>服务类型：（{{$order->classification->name}}）</dd>
                            <dd>期望服务日期：{{$order->hopeServiceAt}}</dd>
                            <dd>订单备注：{{$order->remark ?? '-'}}</dd>
                            <dt>客户地址</dt>
                            <dd>客户姓名：{{$order->customerInfo['name']}}</dd>
                            <dd>联系电话：{{$order->customerInfo['phone']}}</dd>
                            <dd>客户地址： {{$order->customerInfo['address']}}</dd>
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
                                                    <div>（{{$product['category_name'] ? $product['category_name'].
                                                    ($product['child_category_name'] ??'') : ''}}）
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{$product['num']}}个</td>
                                            <td>
                                                {{$product['remark']}}
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
                    <div class="tab-item hide">
                        <ul class="offer-list">
                            @foreach($order->offerOrders as $offerOrder)
                                <li>
                                    <a href="">
                                        <div class="img-box">
                                            <img src="{{$offerOrder->master['avatar']}}">
                                        </div>
                                    </a>
                                    <div class="intro">
                                        <div class="name"><span class="fl">{{$offerOrder->master['name']}}</span>
                                        </div>
                                        <p><span>搬货/</span><span>安装/</span><span>维修</span></p>
                                        <p></p>
                                        <div class="area"><span class="icon">服务范围</span> <b>蜀山区</b><b>市辖区</b><b>瑶海区</b><b>包河区</b><b>庐阳区</b><b>肥西县</b>
                                        </div>
                                    </div>
                                    <div class="data">
                                        <div class="rate">
                                            评分：<b class="f-yellow">4.99分</b>
                                        </div>
                                        <div>服务 79 单 / 与我合作 0 次</div>
                                        <div>好评率100%</div>
                                    </div>
                                    <div class="offer">
                                        <div>
                                            <b>¥{{$offerOrder->quotePriceFormat}}</b>
                                            <button>雇佣并支付</button>
                                            <div class="phone">13252632523</div>
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

</div>

<!--content--end-->

</body>

</html>
<script>
    const currentOrderData = {!! $order !!};
    $(function () {
        $(".info-tab li").click(function () {
            let i = $(this).index()
            console.log(i)
            $(this).addClass('selected').siblings().removeClass('selected');
            $('.tab-content .tab-item').eq(i).addClass('show').siblings().removeClass('show').addClass('hide');
        })
    })
</script>
