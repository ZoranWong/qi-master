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
                <input type="text" placeholder="请输入手机号" maxlength="11">
            </div>
            <div class="input-row get-code-row">
                <label class="icon-code"></label>
                <input type="text" placeholder="请输入验证码">
                <input type="button" id="btn" value="获取验证码" onclick="sendemail()" class="get-code"/>
            </div>
            <div class="code-tip">短信验证码已发送至<span class="special-tip"> 13526325632 </span>,请注意查收</div>
            <div class="content-padded">
                <a href="setpsw.html">下一步</a>
            </div>
        </form>
    </div>

</div>
</body>

<script>
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
