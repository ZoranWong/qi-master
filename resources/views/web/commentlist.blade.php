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
                    <li>待评价</li>
                    <li>已评价</li>
                </ul>
                <div class="layui-tab-content">
                    <div class="layui-tab-item layui-show">
                        <div class="layui-form table-form">
                            <table class="layui-table">
                                <thead>
                                <tr>
                                    <th>订单编号</th>
                                    <th>服务类型</th>
                                    <th>服务商</th>
                                    <th>服务价格</th>
                                    <th>评价状态</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>S2190311085617563</td>
                                    <td>安装</td>
                                    <td>李雪云</td>
                                    <td>￥60.00</td>
                                    <td>已评价</td>
                                    <td>
                                        <a href="">查看</a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div id="pagination"></div>
                    </div>
                    <div class="layui-tab-item">
                        <div class="layui-form table-form">
                            <table class="layui-table">
                                <thead>
                                <tr>
                                    <th>订单编号</th>
                                    <th>服务类型</th>
                                    <th>服务商</th>
                                    <th>服务价格</th>
                                    <th>评价状态</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>S2190311085617563</td>
                                    <td>安装</td>
                                    <td>李雪云</td>
                                    <td>￥60.00</td>
                                    <td>待评价</td>
                                    <td>
                                        <a href="">查看</a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="layui-tab-item">
                        <div class="layui-form table-form">
                            <table class="layui-table">
                                <thead>
                                <tr>
                                    <th>订单编号</th>
                                    <th>服务类型</th>
                                    <th>服务商</th>
                                    <th>服务价格</th>
                                    <th>评价状态</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>S2190311085617563</td>
                                    <td>安装</td>
                                    <td>李雪云</td>
                                    <td>￥60.00</td>
                                    <td>未评价</td>
                                    <td>
                                        <a href="">查看</a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>

        </div>

    </div>

</div>

<!--content--end-->

</body>

</html>
