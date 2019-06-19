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
                    <a href=""></a> <span class="separator">&gt;</span>
                </li>
                <li>收藏的服务商</li>
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
                            <li class="router-link-active">
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
                            <li>
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
            <h2>收藏的服务商</h2>
            <form class="layui-form" action="">
                <div class="layui-form clearfix border">
                    <div class="layui-form-item">
                        <label class="layui-form-label">服务区域</label>
                        <div class="layui-input-block status">
                            <select name="interest" lay-filter="aihao">
                                <option value="" selected="">上海</option>
                                <option value="0">合肥</option>
                            </select>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <button class="layui-btn" lay-submit="" lay-filter="">搜索</button>
                    </div>
                </div>
            </form>
            <div class="layui-form table-form">
                <table class="layui-table">
                    <thead>
                    <tr>
                        <th>姓名</th>
                        <th>服务类型</th>
                        <th>服务区域</th>
                        <th>合作量</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>张祖良</td>
                        <td>家具(配送/搬运/安装/维修)</td>
                        <td>昆明</td>
                        <td>3</td>
                        <td><a href="">雇佣师傅</a></td>
                    </tr>
                    <tr>
                        <td>张祖良</td>
                        <td>家具(配送/搬运/安装/维修)</td>
                        <td>昆明</td>
                        <td>1</td>
                        <td><a href="">雇佣师傅</a></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div id="pagination"></div>

        </div>

    </div>

</div>

<!--content--end-->

</body>

</html>
