<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="/web/css/common.css"/>
    <link rel="stylesheet" href="/web/css/styles.css"/>
    <script type="text/javascript" src="/web/js/jquery-3.3.1.js"></script>
</head>

<body>
<!--header-->
<header>
    <div id="nav">
        <div class="navlist am-container"><a href="index.html"><img src="/web/image/logo.png" class="logo"></a></div>
    </div>
</header>
<!--header end-->


<!--content-->
<div class="forget-psw">
    <div class="max-width">
        <div class="register">
            <div class="register-top">
                <h4><b><img src="/web/image/icon_psw.png"></b>找回密码</h4>
            </div>
            <div class="register-main">
                <div class="register-phone">
                    <input type="number" placeholder="请输入您的手机号" id="login-forget-pass"
                           oninput="if(value.length>11)value=value.slice(0,11)">
                    <span>*</span>
                    <div class="clear"></div>
                </div>
                <div class="register-yzm">
                    <input type="number" placeholder="请输入验证码" oninput="if(value.length>6)value=value.slice(0,6)"
                           id="login-yzm">
                    <button class="login-btn" id="login-btn2" onclick="yzms()">获取验证码</button>
                    <span>*</span>
                    <div class="clear"></div>
                </div>
                <div class="register-password">
                    <input type="password" placeholder="请输入新的密码" id="login-passw">
                    <span>*</span>
                    <div class="clear"></div>
                </div>
                <div class="register-password">
                    <input type="password" placeholder="请再次输入密码" id="login-passw2">
                    <span>*</span>
                    <div class="clear"></div>

                </div>
                <a href="" id="affirm" class="affirm" onclick="affirm()">确认</a>
            </div>
            <div class="register-success">
                <i><img src="/web/image/success.png"></i>
                <p>您已经成功设置密码,请试用新密码登录</p>
                <a href="login.html">立即登录</a>
            </div>
        </div>
    </div>
</div>
<!--content end-->

</body>

</html>
