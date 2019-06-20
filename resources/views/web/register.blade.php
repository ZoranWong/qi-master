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
            <div class="left">
                <div class="welcome">欢迎注册齐师傅<span class="tips"></span></div>
                <ul>
                    <li>
                        <select id="userType"
                                style="width:320px;outline: none;height: 40px;font-size: 15px;color:#999;border:1px solid #e3e1e2;">
                            <option value="">&nbsp;&nbsp;请选择用户类型&nbsp;&nbsp;</option>
                            <option value="1">&nbsp;实体卖家&nbsp;</option>
                            <option value="2">&nbsp;电商卖家&nbsp;</option>
                            <option value="3">&nbsp;个人用户&nbsp;</option>
                            <option value="4">&nbsp;我是师傅&nbsp;</option>
                        </select>
                        <i></i>
                    </li>
                    <li>
                        <input type="tel" id="phone" class="r-phone" maxlength="11" placeholder="请输入您的手机号">
                        <i></i>
                    </li>
                    <li>
                        <input type="text" id="sCode" class="sCode" placeholder="请输入验证码">
                        <button class="getCode" onclick="getCode()">获取验证码</button>
                        <i></i>
                    </li>
                    <li>
                        <input type="password" id="password" class="password" placeholder="请输入您的密码">
                        <i></i>
                    </li>
                    <li>
                        <input type="text" id="recommend" class="recommend" placeholder="推荐人邀请码或手机号">
                    </li>
                </ul>
                <div class="agree">
                    <input type="checkbox" id="agree" checked="">
                    <label for="agree">我已经阅读并同意</label>
                    <a href="">网站注册协议</a>
                </div>
                <button class="register-btn" onclick="register()">立即注册</button>
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
