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
                    <a href=""></a> <span class="separator">&gt;</span></li>
                <li>
                    <a href="security.html">安全设置</a> <span class="separator">&gt;</span></li>
                <li>修改手机号</li>
            </ul>
        </div>
        @include('web.menu')
        <div class="right-content">
            <h2>修改手机号</h2>
            <div>
                <form class="layui-form float-none profile" action="">
                    <div class="layui-form-item">
                        <label class="layui-form-label">原手机号</label>
                        <div class="layui-input-inline modifle-phone">
                            <input type="tel" name="phone" lay-verify="title" autocomplete="off"
                                   placeholder="13623623263" class="layui-input disabled" disabled>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">新手机号</label>
                        <div class="layui-input-inline modifle-phone">
                            <input type="tel" name="phone" lay-verify="title" autocomplete="off" placeholder="请输入新手机号"
                                   class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">验证码</label>
                        <div class="layui-input-inline">
                            <input type="text" name="code" lay-verify="title" autocomplete="off" placeholder="手机验证码"
                                   class="layui-input">
                        </div>
                        <input type="button" id="btn" value="获取验证码" onclick="settime(this)" class="send-code"/>
                    </div>
                    <div class="layui-form-item" id="layerDemo">
                        <button class="layui-btn inquire" data-method="offset" data-type="auto">提交</button>
                    </div>
                </form>
            </div>

        </div>

    </div>

</div>

<!--content--end-->

</body>

</html>
<script>
    layui.use('layer', function () {
        var $ = layui.jquery
        layer = layui.layer;
        var active = {
            offset: function (othis) {
                var type = othis.data('type'),
                    text = othis.text();

                layer.open({
                    type: 1,
                    offset: type,
                    id: 'layerDemo' + type,
                    content: '<div style="padding: 20px 100px;">' + text + '</div>',
                    btn: '关闭全部',
                    btnAlign: 'c',
                    shade: 0,
                    yes: function () {
                        layer.closeAll();
                    }
                });
            }
        };

        $('#layerDemo .layui-btn').on('click', function () {
            var othis = $(this),
                method = othis.data('method');
            active[method] ? active[method].call(this, othis) : '';
        });

    })
    var countdown = 60;

    function settime(obj) {
        if (countdown == 0) {
            obj.removeAttribute("disabled");
            obj.value = "免费获取验证码";
            countdown = 60;
            return;
        } else {
            obj.setAttribute("disabled", true);
            obj.value = "重新发送(" + countdown + ")";
            countdown--;
        }
        setTimeout(function () {
            settime(obj)
        }, 1000)
    }
</script>
