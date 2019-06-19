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
                    <a href=""></a> <span class="separator">&gt;</span>
                </li>

                <li>退款管理</li>
            </ul>
        </div>
        @include('web.menu')
        <div class="right-content">
            <h2>退款管理</h2>
            <form class="layui-form" action="">
                <div class="layui-form clearfix border">
                    <div class="layui-form-item">
                        <div class="layui-inline">
                            <label class="layui-form-label">退款时间</label>
                            <div class="layui-input-inline date-width">
                                <input type="text" class="layui-input" id="selectData" placeholder=" 开始日期-结束日期 ">
                            </div>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">退款状态</label>
                        <div class="layui-input-block status">
                            <select name="interest" lay-filter="aihao">
                                <option value="" selected="">全部状态</option>
                                <option value="0">等待审核中</option>
                                <option value="1">同意退款</option>
                                <option value="2">拒绝退款</option>
                                <option value="3">退款关闭</option>
                                <option value="4">退款成功</option>
                            </select>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">退款类型</label>
                        <div class="layui-input-block status">
                            <select name="interest" lay-filter="aihao">
                                <option value="" selected="">全部</option>
                                <option value="0">全额退款</option>
                                <option value="1">部分退款</option>
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
                    <div class="layui-form-item" style="text-align: left;">
                        <button class="layui-btn" lay-submit="" lay-filter="">搜索</button>
                    </div>
                </div>
            </form>
            <div class="layui-form table-form">
                <table class="layui-table">
                    <thead>
                    <tr>
                        <th>订单编号</th>
                        <th>服务商</th>
                        <th>交易金额</th>
                        <th>退款金额</th>
                        <th>申请时间</th>
                        <th>退款状态</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>P10659001655</td>
                        <td>张祖良</td>
                        <td>200.00</td>
                        <td>200.00</td>
                        <td>2019-03-20 17:00:41</td>
                        <td>退款成功</td>
                        <td><a href="/refund/3">查看</a></td>
                    </tr>
                    <tr>
                        <td>P10659001655</td>
                        <td>张祖良</td>
                        <td>200.00</td>
                        <td>200.00</td>
                        <td>2019-03-20 17:00:41</td>
                        <td>退款成功</td>
                        <td><a href="/refund/1">查看</a></td>
                    </tr>
                    <tr>
                        <td>P10659001655</td>
                        <td>张祖良</td>
                        <td>200.00</td>
                        <td>200.00</td>
                        <td>2019-03-20 17:00:41</td>
                        <td>退款成功</td>
                        <td><a href="/refund/2">查看</a></td>
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
<script>
    layui.use(['form', 'layedit', 'laydate', 'laypage'], function () {
        var form = layui.form,
            layer = layui.layer,
            layedit = layui.layedit,
            laydate = layui.laydate;
        laypage = layui.laypage
        laydate.render({
            elem: '#selectData',
            range: true
        });
        laypage.render({
            elem: 'pagination',
            count: 70, //数据总数
            jump: function (obj) {
                //console.log(obj)
            }
        });
    })
</script>
