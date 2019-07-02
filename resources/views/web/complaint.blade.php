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
                <li>投诉管理</li>
            </ul>
        </div>
        @include('web.menu')
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
                    @foreach($complaints as $complaint)
                        <tr>
                            <td>{{$complaint->orderNo}}</td>
                            <td>{{$complaint->masterName}}</td>
                            <td>{{$complaint->complaintNo}}</td>
                            <td>{{$complaint->compensationFormat}}元</td>
                            <td>{{$complaint->applyAt}}</td>
                            <td>{{$complaint->statusDes}}</td>
                            <td><a href="/">查看</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div id="complaintPagination"></div>

        </div>

    </div>

</div>

<!--content--end-->

</body>
<script>
    layui.use(['laypage'], function () {
        let laypage = layui.laypage;
        let first = true;
        laypage.render({
            elem: 'complaintPagination',
            count: {{$count}}, //数据总数
            curr: {{$page}},
            limit: {{$limit}},
            jump: function (obj) {
                console.log(obj);
                if (!first) {
                    location.href = "/complaint?&page=" + obj.curr + '&limit=' + obj.limit;
                }
                first = false;
            }
        });
    })
</script>
</html>
