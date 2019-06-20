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
                    <a href=""></a> <span class="separator">&gt;</span></li>
                <li>
                    <a href="">退款管理</a> <span class="separator">&gt;</span></li>
                <li>退款申请</li>
            </ul>
        </div>
        @include('web.menu')
        <div class="right-content">
            <h2>退款申请</h2>
            <div class="flow">
                <ul class="clearfix">
                    <li class="active-color">
                        1、申请退款
                    </li>
                    <li>
                        2、师傅处理退款申请
                    </li>
                    <li>
                        3、退款完成
                    </li>
                </ul>
            </div>
            <div class="state">
                <span>退款状态：</span>
                <span class="notify-tips font-mid">退款申请中，等待服务商审核</span>
                <a href="##" class="fr">取消退款</a>
            </div>
            <div class="refund-order clearfix border-color">
                <div class="fl">
                    <h3>退款信息</h3>
                    <ul>
                        <li>
                            <span>申请服务：</span>
                            <span>全额退款</span>
                        </li>
                        <li>
                            <span>需要退款：</span>
                            <span>109.00 元</span>
                        </li>
                        <li>
                            <span>退款方式：</span>
                            <span>原路返回</span>
                        </li>
                        <li>
                            <span>服务状态：</span>
                            <span class="red">申请中</span>
                        </li>
                        <li>
                            <span>退款说明：</span>
                            <span>需要二次上门后再提交订单</span>
                        </li>
                        <li>
                            <span>退款编号：</span>
                            <span>10673877222</span>
                        </li>
                        <li>
                            <span>申请时间：</span>
                            <span>2019-03-21 09:11</span>
                        </li>
                    </ul>
                </div>
                <div class="fr inner">
                    <h3>退款订单信息</h3>
                    <ul>
                        <li>
                            <span>退款订单：</span>
                            <span>S2190224133348597</span>
                        </li>
                        <li>
                            <span>订单金额：</span>
                            <span>109.00 元</span>
                        </li>
                        <li>
                            <span>下单时间：</span>
                            <span>2019-03-21 09:11</span>
                        </li>
                    </ul>
                </div>

            </div>
            <div class="refund-order border-color">
                <h3>服务商处理结果</h3>
                <ul>
                    <li>
                        <span>审核操作：</span>
                        <span class="red">不同意退款</span>
                    </li>
                    <li>
                        <span>退款金额：</span>
                        <span>109.00 元</span>
                    </li>
                    <li>
                        <span>审核说明：</span>
                        <span>已安装好了</span>
                    </li>
                    <li>
                        <span>审核时间：</span>
                        <span>2019-03-21 09:11</span>
                    </li>
                </ul>
            </div>

        </div>

    </div>

</div>

<!--content--end-->

</body>

</html>
<script>
</script>
