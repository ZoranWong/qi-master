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
    <script type="text/javascript" src="/web/js/layuicom.js"></script>
    <script type="text/javascript" src="/web/plugin/pccity/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/web/plugin/pccity/js/distpicker.data.js"></script>
    <script type="text/javascript" src="/web/plugin/pccity/js/distpicker.js"></script>
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
                <li>基本资料</li>
            </ul>
        </div>
        @include('web.menu')
        <div class="right-content enterprise">
            <h2>企业认证</h2>
            <div>
                <form class="layui-form float-none profile" action="">
                    <h3>企业信息</h3>
                    <div class="clearfix ">
                        <div class="layui-form-item">
                            <label class="layui-form-label">企业证件类型</label>
                            <div class="layui-input-block">
                                <input type="radio" name="cert" lay-filter="genre" value="普通营业执照" title="普通营业执照"
                                       checked="">
                                <input type="radio" name="cert" lay-filter="genre" value="多证合一营业执照" title="多证合一营业执照">
                            </div>
                        </div>
                        <div class="identity-card">
                            <div class="fl">
                                <img src="/web/image/vali.png">
                                <span>营业执照</span>
                                <input type="file" accept="image/*">
                            </div>
                            <div class="fr enter-normal">
                                <img src="/web/image/vali.png">
                                <span>组织机构代码</span>
                                <input type="file" accept="image/*">
                            </div>
                        </div>

                    </div>
                    <h3>法人信息</h3>
                    <div class="clearfix identity-card">
                        <div class="fl">
                            <img src="/web/image/id_front.png">
                            <span>身份证人像面</span>
                            <input type="file" accept="image/*">
                        </div>
                        <div class="fr">
                            <img src="/web/image/id_reverse.png">
                            <span>身份证国徽面</span>
                            <input type="file" accept="image/*">
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">姓名</label>
                        <div class="layui-input-inline">
                            <input type="text" name="name" lay-verify="title" autocomplete="off"
                                   placeholder="请输入法定代表人姓名" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">身份证号码</label>
                        <div class="layui-input-inline">
                            <input type="number" name="code" lay-verify="title" autocomplete="off"
                                   placeholder="请输入身份证号码" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">身份证有效期</label>
                        <div class="layui-input-inline">
                            <input type="text" class="layui-input date" placeholder="年-月-日">
                        </div>
                        <span class="fl" style="margin-top: 10px;">至</span>
                        <div class="layui-input-inline end-date-1" style="margin-left: 10px;">
                            <input type="text" class="layui-input date" placeholder="年-月-日">
                        </div>
                        <div class="layui-input-inline end-date-2 hide" style="margin-left: 10px;">
                            <input type="text" class="layui-input" placeholder="年-月-日" value="长期" disabled="true">
                        </div>
                        <div class="layui-input-inline">
                            <span class="line-bet"></span><input type="checkbox" name="idinfo" lay-filter="idinfo"
                                                                 value="长期" title="长期">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">联系电话</label>
                        <div class="layui-input-inline">
                            <input type="tel" name="tel" lay-verify="title" autocomplete="off" placeholder="请输入手机号码"
                                   class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">短信验证码</label>
                        <div class="layui-input-inline">
                            <input type="number" name="smscode" lay-verify="title" autocomplete="off"
                                   placeholder="请输入验证码" class="layui-input">
                        </div>
                        <input class="layui-btn inquire" style="margin-left: 0px;padding: 0px;" onclick="settime(this)"
                               value="获取短信验证码">
                    </div>
                    <div class="layui-form-item" style="margin-left: 13px;">
                        <button class="layui-btn inquire" lay-submit="" lay-filter="">提交</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--content--end-->

</body>
<script>
    $(function () {
        $(".layui-form-radio").click(function () {
            console.log(1)
        })
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
            obj.style.background = "#ccc"
            obj.value = "重新发送(" + countdown + ")";
            countdown--;
        }
        setTimeout(function () {
            settime(obj)
        }, 1000)
    }
</script>

</html>
