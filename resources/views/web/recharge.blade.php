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
    <script type="text/javascript" src="/web/js/layuicom.js"></script>
</head>

<body>
<!--header-->
<header>
    <div id="header">
        <div class="header-a">
            <div class="nav-a" style="padding-right: 0px; border: 0px;">
                <a href="">您好，</a>
            </div>
            <div class="nav-a" style="padding-right: 0px; border: 0px;">
                <a href="" class="" style="padding-right: 0px;">我的订单</a>
            </div>
            <div class="nav-a">
                <a href="javascript:void(0)">退出</a>
            </div>
            <div class="nav-a">
                <a href="/">官网首页</a>
            </div>
            <div class="nav-a">
                <a href="">优惠活动</a>
            </div>
            <div class="nav-a">
                <a href="">商户APP</a>
            </div>
            <div class="nav-a">
                <a href="">师傅入驻</a>
            </div>
            <div class="nav-b">
                <a href="">家庭用户</a>
            </div>
        </div>
    </div>
    <div id="nav">
        <div class="navlist am-container"><img src="/web/image/logo.png" class="logo">
            <ul id="tabs_nav" class="boxlie">
                <li class="selected">
                    <a href="index.html">我的首页</a>
                </li>
                <li>
                    <a href="order.html">订单管理</a>
                </li>
                <li>
                    <a href="refund.html">维权中心</a>
                </li>
                <li>
                    <a href="mywallet.html">我的钱包</a>
                </li>
                <li>
                    <a href="profile.html">账号管理</a>
                </li>
                <li>
                    <a href="message.html">服务中心</a>
                </li>
            </ul>
            <div class="make-order">
                <a href="publish.html">立即找师傅</a>
            </div>
        </div>
    </div>
</header>

<!--header end-->

<!--content-->
<div class="distance">
    <div class="max-width">
        <div class="crumbs">
            <ul class="clearfix">
                <li>您的位置：</li>
                <li>
                    <a href="index.html">首页</a>
                </li>
                <li>
                    <a href=""></a> <span class="separator">&gt;</span>
                </li>
                <li>账户充值</li>
            </ul>
        </div>
        <div class="pay">
            <form class="clearfix">
                <div class="clearfix item">
                    <label class="layui-form-label">充值金额</label>
                    <ul class="select-money">
                        <li class="active">500</li>
                        <li>1000</li>
                        <li>1500</li>
                        <li class="recharge-money"><input type="text" placeholder="请输入充值金额" class="input"></li>
                    </ul>

                </div>
                <div class="item">
                    <label class="layui-form-label">支付方式</label>
                    <ul class="select-method clearfix">
                        <li class="active">
                            <i class="alipay"></i>
                            支付宝
                        </li>
                        <li>
                            <i class="wechat"></i>
                            微信
                        </li>
                    </ul>
                </div>
                <div class="layui-form-item">
                    <button class="layui-btn inquire" lay-submit="" lay-filter="">立即充值</button>
                </div>
            </form>
        </div>

    </div>
</div>
<!--content end-->
</body>
<script>
    $(".select-method li").click(function () {
        var index = $(this).index()
        $(".select-method li").removeClass("active")
        $(".select-method li:eq(" + index + ")").addClass("active")

    })

    $(".select-money li").click(function () {
        var index = $(this).index()
        $(".select-money li").removeClass("active")
        $(".select-money li:eq(" + index + ")").addClass("active")

    })
</script>

</html>
