<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title></title>
    <meta content="yes" name="apple-mobile-web-app-capable"/>
    <meta content="black" name="apple-mobile-web-app-status-bar-style"/>
    <meta name="viewport"
          content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no"/>
    <link rel="stylesheet" href="/h5/css/base.css"/>
    <link rel="stylesheet" href="/h5/css/index.css"/>
    <script type="text/javascript" src="/h5/js/jquery-3.3.1.js"></script>
    <script type="text/javascript" src="/h5/js/rem.js"></script>
</head>

<body>
<div class="wrap login">
    <div class="top-h">
        <div class="logo"><!--<img src="style/img/logo.png">--></div>
    </div>
    <div>
        <form class="input-group">
            <div class="input-row">
                <label class="icon-phone"></label>
                <input type="text" placeholder="请输入您的手机号" maxlength="11">
            </div>
            <div class="input-row">
                <label class="icon-code"></label>
                <input type="text" placeholder="请输入验证码">
                <input type="button" id="btn" value="获取验证码" onclick="sendemail()" class="get-code"/>
            </div>
            <div class="input-row">
                <label class="icon-psw"></label>
                <input type="password" placeholder="请输入登录密码">
            </div>
            <div class="input-row">
                <label class="icon-psw"></label>
                <input type="text" placeholder="再次输入密码">
            </div>
            <div class="input-row">
                <label class="icon-invi"></label>
                <input type="text" placeholder="推荐人邀请码或手机号(可不填)">
            </div>
            <div class=""><input type="checkbox" name="isAgree"> 阅读并接受<a href="" class="tip-color">《用户注册协议》</a></div>
            <div class="content-padded">
                <button>确认注册</button>
            </div>

        </form>
    </div>

</div>
</body>
<script type="text/javascript">
    //获取验证码
    var countdown = 60;

    function sendemail() {
        var obj = $("#btn");
        settime(obj);

    }

    function settime(obj) { //发送验证码倒计时

        if (countdown == 0) {
            $(".code-tip").hide()
            obj.removeClass('disabled')
            obj.attr('disabled', false);
            obj.val("获取验证码");
            countdown = 60;
            return;
        } else {
            $(".code-tip").show()
            obj.attr('disabled', true);
            obj.addClass('disabled')
            obj.val("重新发送(" + countdown + ")");
            countdown--;
        }
        setTimeout(function () {
            settime(obj)
        }, 1000)
    }
</script>

</html>
