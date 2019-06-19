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
                <li>投诉管理</li>
            </ul>
        </div>
        <div class="left-nav">
            <div class="my-center">
                <a href="">我的中心</a>
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
                            <li class="router-link-active">
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
            <h2>投诉管理</h2>
            <form class="layui-form" action="">
                <div class="layui-form clearfix border">
                    <div class="layui-form-item">
                        <div class="layui-inline">
                            <label class="layui-form-label">发起时间</label>
                            <div class="layui-input-inline date-width">
                                <input type="text" class="layui-input" id="selectData" placeholder=" 开始日期-结束日期 ">
                            </div>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">投诉状态</label>
                        <div class="layui-input-block status">
                            <select name="interest" lay-filter="aihao">
                                <option value="" selected="">全部状态</option>
                                <option value="0">待处理</option>
                                <option value="1">投诉成功</option>
                                <option value="2">投诉失败</option>
                            </select>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">订单编号</label>
                        <div class="layui-input-inline order-num">
                            <input type="text" name="username" lay-verify="required" placeholder="请输入订单号"
                                   autocomplete="off" class="layui-input">
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
                        <th>订单编号</th>
                        <th>投诉对象</th>
                        <th>投诉编号</th>
                        <th>赔付金额</th>
                        <th>发起时间</th>
                        <th>投诉状态</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>P10659001655</td>
                        <td>张祖良</td>
                        <td>C201804291902585</td>
                        <td>30.00元</td>
                        <td>2019-03-20 17:00:41</td>
                        <td>投诉完成</td>
                        <td><a href="complaintdetail.html">查看</a></td>
                    </tr>
                    <tr>
                        <td>P10659001655</td>
                        <td>张祖良</td>
                        <td>C201804291902585</td>
                        <td>30.00元</td>
                        <td>2019-03-20 17:00:41</td>
                        <td>投诉完成</td>
                        <td><a href="">查看</a></td>
                    </tr>
                    <tr>
                        <td>P10659001655</td>
                        <td>张祖良</td>
                        <td>C201804291902585</td>
                        <td>30.00元</td>
                        <td>2019-03-20 17:00:41</td>
                        <td>投诉完成</td>
                        <td><a href="complaintdetail.html">查看</a></td>
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
