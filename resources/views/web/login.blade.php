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
    <div id="nav">
        <div class="navlist am-container"><a href="index.html"><img src="/web/image/logo.png" class="logo"></a></div>
    </div>
</header>

<!--header end-->

<!--content start-->
<div class="login">
    <div class="max-width login-content">
        <div class="login-box">
            <div class="title">
                <span class="icon">用户登录</span>
                <span class="fr">还没有账号？ <a href="register">立即注册&gt;&gt;</a></span>
            </div>
            <input type="tel" id="phone" class="login-phone" maxlength="11" placeholder="请输入您的手机号">
            <input type="password" id="password" class="password" placeholder="请输入您的密码">
            <button onclick="login()">立即登录</button>
            <div class="forget">
                <a href="forget/password">忘记密码</a>
            </div>
        </div>
    </div>

</div>
<!--content end-->
</body>
<script>
    $loginUrl = '{{$loginRoute}}';
    function login() {

    }
</script>
</html>
