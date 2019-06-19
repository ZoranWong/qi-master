<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title></title>
    <title></title>
    <link rel="stylesheet" href="/web/plugin/layui/css/layui.css"/>
    <link rel="stylesheet" href="/web/css/common.css"/>
    <link rel="stylesheet" href="/web/css/styles.css"/>
    <script type="text/javascript" src="/web/js/jquery-3.3.1.js"></script>
    <script type="text/javascript" src="/web/plugin/layui/layui.js"></script>
</head>


<body>
<!--header-->
<header>
    <div id="header">
        <div class="header-a">
            <div class="nav-a">
                <a href="login.html">登录</a>
            </div>
            <div class="nav-a">
                <a href="register.html">免费注册</a>
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
</header>
<!--header end-->

<!--content start-->
<div class="login">
    <div class="max-width login-content">
        <div class="login-box">
            <div class="title">
                <span class="icon">找回密码</span>
            </div>
            <input type="tel" id="phone" class="login-phone" maxlength="11" placeholder="请输入您的手机号">
            <input type="password" id="password" class="password" placeholder="请输入您的密码">
            <button onclick="login()">立即登录</button>
            <div class="forget">
                <a href="psw.html">忘记密码</a>
            </div>
        </div>
    </div>

</div>

<!--content end-->


</body>

</html>
