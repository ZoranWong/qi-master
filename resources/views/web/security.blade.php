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
                <li>安全设置</li>
            </ul>
        </div>
        @include('web.menu')
        <div class="right-content">
            <h2>安全设置</h2>

            <div class="security">
                <ul>
                    <li>
                        <span>登录密码<em>已设置</em></span>
                        <span>互联网账号存在被盗风险，建议您定期更改密码以保护账户安全。</span>
                        <a href="{{}}">修改密码</a>
                    </li>
                    <li>
                        <span>钱包密码<em>已设置</em></span>
                        <span>您在钱包支付时可使用该密码</span>
                        <a href="modifywalletpsw.html">修改密码</a>
                    </li>
                    <li>
                        <span>手机验证<em>已设置</em></span>
                        <span>手机若已丢失或停用，请立即更换，避免账户被盗</span>
                        <a href="modifphone.html">修改手机</a>
                    </li>
                </ul>
            </div>


        </div>

    </div>

</div>

<!--content--end-->

</body>

</html>
