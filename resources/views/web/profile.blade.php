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
<header>
    <div id="header">
        <div class="header-a">
            <div class="nav-a" style="padding-right: 0px; border: 0px;">
                <a href="">您好，</a>
            </div>
            <div class="nav-a" style="padding-right: 0px; border: 0px;">
                <a href="" class="" style="padding-right: 0px;">我的订单</a>
            </div>
            <div class="nav-a">
                <a href="javascript:void(0)">退出</a>
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
    <div id="nav">
        <div class="navlist am-container"><img src="/web/image/logo.png" class="logo">
            <ul id="tabs_nav" class="boxlie">
                <li>
                    <a href="index.html">我的首页</a>
                </li>
                <li>
                    <a href="order.html">订单管理</a>
                </li>
                <li>
                    <a href="refund.html">维权中心</a>
                </li>
                <li>
                    <a href="mywallet.html">我的钱包</a>
                </li>
                <li class="selected">
                    <a href="profile.html">账号管理</a>
                </li>
                <li>
                    <a href="message.html">服务中心</a>
                </li>
            </ul>
            <div class="make-order">
                <a href="publish.html">立即找师傅</a>
            </div>
        </div>
    </div>
</header>

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
        <div class="left-nav">
            <div class="my-center">
                <a href="index.html">
                    <i></i>
                    <span>个人中心</span>
                </a>
            </div>
            <div>
                <ul class="second-menu">
                    <li class="active">
                        <div><i class="icon-menu-1"></i>订单中心</div>
                        <ul>
                            <li>
                                <a href="order.html">全部订单</a>
                            </li>
                            <li>
                                <a href="comment.html">我的评价</a>
                            </li>
                            <li>
                                <a href="gallery.html">商品管理</a>
                            </li>
                            <li>
                                <a href="favorite.html">收藏的服务商</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <div><i class="icon-menu-2"></i>维权中心</div>
                        <ul>
                            <li>
                                <a href="refund.html">退款管理</a>
                            </li>
                            <li>
                                <a href="complaint.html">投诉管理</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <div><i class="icon-menu-3"></i>我的钱包</div>
                        <ul>
                            <li>
                                <a href="mywallet.html">钱包余额</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <div><i class="icon-menu-4"></i>个人中心</div>
                        <ul>
                            <li class="router-link-active">
                                <a href="profile.html">基本资料</a>
                            </li>
                            <li>
                                <a href="security.html">安全设置</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <div><i class="icon-menu-5"></i>服务中心</div>
                        <ul>
                            <li>
                                <a href="message.html">我的消息</a>
                            </li>

                            <li>
                                <a href="security.html">资质管理</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <div class="right-content">
            <h2>基本资料</h2>
            <div>
                <form class="layui-form float-none profile" action="">
                    <div class="layui-form-item modify-head-img">
                        <label class="layui-form-label">头像</label>
                        <div class="layui-input-inline">
                            <div class="upload-head-img">
                                <img src="/web/image/portrait.png" id="headimg">
                                <input type="file" accept="image/*" id="upload-head-img">
                            </div>
                        </div>
                    </div>
                    <div class="layui-form-item" style="margin-top: 65px;">
                        <label class="layui-form-label">用户名</label>
                        <div class="layui-input-inline">
                            <input type="text" name="username" lay-verify="title" autocomplete="off" placeholder="浅浅"
                                   class="layui-input disabled" disabled>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">注册类型</label>
                        <div class="layui-input-inline">
                            <select name="interest" lay-filter="aihao">
                                <option value="" selected="">家具商家</option>
                                <option value="0">灯具商家</option>
                                <option value="1">个人</option>
                            </select>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">姓名</label>
                        <div class="layui-input-inline">
                            <input type="text" name="name" lay-verify="title" autocomplete="off" placeholder="请输入姓名"
                                   class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">性别</label>
                        <div class="layui-input-block">
                            <input type="radio" name="sex" value="保密" title="保密" checked="">
                            <input type="radio" name="sex" value="男" title="男">
                            <input type="radio" name="sex" value="女" title="女">
                        </div>
                    </div>
                    <div class="clearfix">
                        <label class="layui-form-label">所在地区</label>
                        <div id="distpicker">
                            <select></select>
                            <select></select>
                            <select></select>
                        </div>
                    </div>
                    <div class="layui-form-item layui-form-text">
                        <label class="layui-form-label">详细地址</label>
                        <div class="layui-input-inline">
                            <textarea placeholder="请输入详细地址" class="layui-textarea"></textarea>
                        </div>
                    </div>
                    <div class="layui-form-item" style="margin-left: 13px;">
                        <button class="layui-btn inquire" lay-submit="" lay-filter="">保存</button>
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
    $("#distpicker").distpicker();
    //上传头像
    $(function () {
        $("#upload-head-img").change(function () {
            var $file = $(this);
            var fileObj = $file[0];
            var windowURL = window.URL || window.webkitURL;
            var dataURL;
            var $img = $("#headimg");
            if (fileObj && fileObj.files && fileObj.files[0]) {
                dataURL = windowURL.createObjectURL(fileObj.files[0]);
                console.log(dataURL)
                $img.attr('src', dataURL);
            } else {
                dataURL = $file.val();
                var imgObj = document.getElementById("headimg");　　　　　　　　 // 1、在设置filter属性时，元素必须已经存在在DOM树中，动态创建的Node，也需要在设置属性前加入到DOM中，先设置属性再加入，无效；
                // 2、src属性需要像下面的方式添加，上面的两种方式添加，无效；

                imgObj.style.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale)";
                imgObj.filters.item("DXImageTransform.Microsoft.AlphaImageLoader").src = dataURL;
            }
        });


    })
</script>
