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
<header>
    <div id="nav">
        <div class="navlist am-container"><a href="index.html"><img src="/web/image/logo.png" class="logo"></a></div>
    </div>
</header>

<!--header end-->

<!--content start-->
<div class="user-bg">
    <div class="max-width">
        <div class="register-box">
            <div class="title">
                <span class="fr">已有账号？ <a href="login">立即登录&gt;&gt;</a></span>
            </div>
            <div class="left layui-form">
                <div class="welcome">欢迎注册齐师傅<span class="tips"></span></div>
                <ul>
                    <li class="layui-form-item">
                        <input type="tel" id="phone" class="r-phone" maxlength="11" placeholder="请输入您的手机号">
                        <i></i>
                    </li>
                    {{--<li>--}}
                        {{--<input type="text" id="sCode" class="sCode" placeholder="请输入验证码">--}}
                        {{--<button class="getCode" onclick="getCode()">获取验证码</button>--}}
                        {{--<i></i>--}}
                    {{--</li>--}}
                    <li class="layui-form-item">
                        <input type="password" id="password" class="password" placeholder="请输入您的密码">
                        <i></i>
                    </li>
                    <li>
                        <input type="password" id="password_confirmation" class="password_confirmation" placeholder="请再次输入密码">
                        <i></i>
                    </li>
                </ul>
                <div class="agree layui-form-item">
                    <input type="checkbox" id="agree" checked="">
                    <label for="agree">我已经阅读并同意</label>
                    <a href="">网站注册协议</a>
                </div>
                <div class="layui-form-item">
                    <button class="register-btn" onclick="register()">立即注册</button>
                </div>
            </div>
            <div class="line"><img src="/web/image/line.png"></div>
            <div class="right">
                <a href=""><img style="width: 340px;" src="/web/image/bg_img.jpg">
                </a>
            </div>

        </div>
    </div>
</div>
<!--content end-->
</body>

</html>
