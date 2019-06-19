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
    <script type="text/javascript" src="/web/js/upload_pic.js"></script>
    <script type="text/javascript" src="/web/js/select.js"></script>
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
                <li>商品管理</li>
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
                            <li class="router-link-active">
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
        <div class="right-content goods-gallery">
            <h2>商品管理</h2>
            <form class="layui-form " action="">
                <div class="upload " data-method="offset" data-type="auto">
                    <em></em> 上传商品图片
                </div>
                <div class="layui-form clearfix gallery">
                    <div class="layui-form-item">
                        <label class="layui-form-label">选择商品类型</label>
                        <div class="layui-input-block">
                            <select name="interest" lay-filter="">
                                <option value="" selected="">全部</option>
                                <option value="0">床类</option>
                                <option value="1">沙发类</option>
                                <option value="2">吊灯</option>
                                <option value="3">家具</option>
                            </select>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <button class="layui-btn" lay-submit="" lay-filter="">查询</button>
                    </div>
                    <div class="layui-form-item">
                        <button class="layui-btn" lay-submit="" lay-filter="">批量操作</button>
                    </div>
                </div>
            </form>
            <ul class="template-con">
                <li>
                    <div class="img-list-con">
                        <img src="/web/image/product.jpg">
                        <div class="template-mask">
                            <span class="edit" data-method="offset" data-type="auto-edit">查看</span>
                            <span class="del">删除</span>
                        </div>
                    </div>
                    <div class="text-con">
                        <span>柜类</span>
                        <em>属性规格</em>
                    </div>
                </li>
                <li>
                    <div class="img-list-con">
                        <img src="/web/image/product.jpg">
                        <div class="template-mask">
                            <span class="edit">查看</span>
                            <span class="del">删除</span>
                        </div>
                    </div>
                    <div class="text-con">
                        <span>柜类</span>
                        <em>属性规格</em>
                    </div>

                </li>

            </ul>
        </div>
    </div>
</div>

<!--content--end-->

<!--upload-->
<div id="template" class="template">
    <form class="layui-form" action="">
        <div class="layui-form clearfix">
            <div class="layui-form-item">
                <label class="layui-form-label">上传图片</label>
                <div class="upload_file_pic clearfix fl" id="upload">
                    <div class="upload_file">
                        <input type="file" name="file" id="file" value="" accept="image/*" multiple
                               onchange="imgChange(this,1,4);"/>
                    </div>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">商品类目</label>
                <div class="layui-input-block">
                    <select name="interest" lay-filter="">
                        <option value="" selected="">全部</option>
                        <option value="0">床类</option>
                        <option value="1">沙发类</option>
                        <option value="2">吊灯</option>
                        <option value="3">家具</option>
                    </select>
                </div>
            </div>
            <div class="layui-form-item myselect">
                <label class="layui-form-label">商品类型</label>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">商品规格</label>
                <div class="layui-input-block">
                    <input type="text" name="title" lay-verify="title" autocomplete="off" placeholder="请输入商品规格"
                           class="layui-input">
                </div>
            </div>
        </div>
    </form>

</div>
<!--upload--end-->

<!--edit-->
<div id="template-edit" class="template">
    <form class="layui-form" action="">
        <div class="layui-form clearfix">
            <div class="layui-form-item">
                <label class="layui-form-label">商品类目</label>
                <div class="layui-input-block">
                    <select name="interest" lay-filter="">
                        <option value="">全部</option>
                        <option value="0" selected="">柜类</option>
                        <option value="1">沙发类</option>
                        <option value="2">吊灯</option>
                        <option value="3">家具</option>
                    </select>
                </div>
            </div>
            <div class="layui-form-item myselect">
                <label class="layui-form-label">商品类型</label>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">商品规格</label>
                <div class="layui-input-block">
                    <input type="text" name="title" lay-verify="title" autocomplete="off" placeholder="请输入商品规格"
                           class="layui-input">
                </div>
            </div>
        </div>
    </form>

</div>
<!--edit--end-->


</body>

</html>
