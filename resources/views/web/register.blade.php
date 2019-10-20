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
                        <input type="tel" id="phone" name="mobile" class="r-phone" lay-verify="required|phone|number" maxlength="11" placeholder="请输入您的手机号">
                        <i></i>
                    </li>
                    {{--<li>--}}
                        {{--<input type="text" id="sCode" class="sCode" placeholder="请输入验证码">--}}
                        {{--<button class="getCode" onclick="getCode()">获取验证码</button>--}}
                        {{--<i></i>--}}
                    {{--</li>--}}
                    <li class="layui-form-item">
                        <input type="password" name="password" lay-verify="password" id="password" class="required|password" placeholder="请输入您的密码">
                        <i></i>
                    </li>
                    <li class="layui-form-item">
                        <input type="password" name = "confirm_password" id="password_confirmation" lay-verify="required|confirm_password"  class="password_confirmation" placeholder="请再次输入密码">
                        <i></i>
                    </li>
                </ul>
                <div class="agree layui-form-item">
                    <input type="checkbox" id="agree" checked="">
                    <label for="agree">我已经阅读并同意</label>
                    <a href="">网站注册协议</a>
                </div>
                <div class="layui-form-item">
                    <button class="register-btn" lay-submit lay-filter="*">立即注册</button>
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
<script>
    layui.use('form', function(){
        var form = layui.form;
        form.verify({
            //我们既支持上述函数式的方式，也支持下述数组的形式
            //数组的两个值分别代表：[正则匹配、匹配不符时的提示文字]
            password: [
                /^[\S]{6,12}$/
                ,'密码必须6到12位，且不能出现空格'
            ],
            confirm_password: function (value) {
                if(!new RegExp( /^[\S]{6,12}$/).test(value)) {
                    return '密码必须6到12位，且不能出现空格';
                }else if($('input[name="password"]').val() !== value) {
                    return '两次输入密码不一致';
                }
            }
        });

        form.on('submit(*)', function(data){
            console.log(data.elem) //被执行事件的元素DOM对象，一般为button对象
            console.log(data.form) //被执行提交的form对象，一般在存在form标签时才会返回
            console.log(data.field) //当前容器的全部表单字段，名值对形式：{name: value}
            return false; //阻止表单跳转。如果需要表单跳转，去掉这段即可。
        });
        //各种基于事件的操作，下面会有进一步介绍
    });
</script>
</html>
