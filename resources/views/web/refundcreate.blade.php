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
                <li class="selected">
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
                <li>
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
                    <a href=""></a> <span class="separator">&gt;</span></li>
                <li>
                    <a href="order.html">订单管理</a> <span class="separator">&gt;</span></li>
                <li>退款申请</li>
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
                                <a href="enterprise.html">资质管理</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <div class="right-content">
            <h2>退款申请</h2>
            <div>
                <div class="notify-tips"><i></i>为了交易双方的公平性，申请的售后都会先有平台客户进行调查取证，确认问题后再给用户满意的处理结果！</div>
                <div class="refund-order">
                    <h3>退款订单信息</h3>
                    <ul>
                        <li>
                            <span>订单编号:</span>
                            <span>P10672973399</span>
                        </li>
                        <li>
                            <span>订单金额:</span>
                            <span>109.00 元</span>
                        </li>
                        <li>
                            <span>可退款金额:</span>
                            <span>109.00 元</span>
                        </li>
                        <li>
                            <span>下单时间:</span>
                            <span>2019-03-21 09:11</span>
                        </li>
                    </ul>
                </div>
                <form class="layui-form float-none profile" action="">
                    <div class="layui-form-item">
                        <label class="layui-form-label">申请服务</label>
                        <div class="layui-input-block">
                            <input type="radio" name="refund" value="全额退款" title="全额退款" checked="">
                            <input type="radio" name="refund" value="部分退款" title="部分退款">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">退款金额</label>
                        <div class="layui-input-inline">
                            <input type="text" name="username" lay-verify="title" autocomplete="off"
                                   placeholder="剩余服务费用不得低于5元" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item layui-form-text">
                        <label class="layui-form-label">退款原因</label>
                        <div class="layui-input-inline">
                            <textarea placeholder="输入您申请退款的原因（100字内）" class="layui-textarea" maxlength="100"></textarea>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <button class="layui-btn inquire" lay-submit="" lay-filter="">提交退款申请</button>
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
    layui.use(['form', 'layedit', 'laydate', 'upload'], function () {
        var form = layui.form,
            layer = layui.layer;
        layedit = layui.layedit;
        laydate = layui.laydate;
        upload = layui.upload;
        laydate.render({
            elem: '#selectData',
            range: true
        });

    })
</script>
