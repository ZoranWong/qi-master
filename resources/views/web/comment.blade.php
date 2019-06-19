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
                <li>我的评价</li>
            </ul>
        </div>
        @include('web.menu')
        <div class="right-content">
            <h2>评价管理</h2>
            <div class="layui-tab">
                <ul class="layui-tab-title">
                    <li class="layui-this">全部</li>
                    <li>好评</li>
                    <li>差评</li>
                </ul>
                <div class="layui-tab-content" id="comment">
                    <div class="layui-tab-item layui-show">
                        <div class="common-wrap">
                            <div>
                                <ul>
                                    <li><span>服务类型：安装</span><span>订单：<a href="" class="f-yellow">P10581334689</a></span><span>服务价格：195.00元</span><span
                                        class="fr"><span style="display: inline-block; margin: 0px; padding: 0px;">2019-03-28 13:56</span></span>
                                    </li>
                                    <li><span>好评</span><span> | 质量（5）</span><span>态度（5）</span><span>速度（5）</span></li>
                                    <li><span>评价：</span><span>系统默认好评（用户超过15天未评价）</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="layui-tab-item">

                    </div>
                    <div class="layui-tab-item">

                    </div>
                </div>
            </div>

        </div>

    </div>

</div>

<!--content--end-->

</body>

</html>
