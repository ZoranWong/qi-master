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
                <li>收藏的服务商</li>
            </ul>
        </div>
        @include('web.menu')
        <div class="right-content">
            <h2>收藏的服务商</h2>
            <form class="layui-form" action="">
                <div class="layui-form clearfix border">
                    <div class="layui-form-item">
                        <label class="layui-form-label">服务区域</label>
                        <div class="layui-input-block status">
                            <select name="interest" lay-filter="aihao">
                                @foreach($regions as $region)
                                    <option value="{{$region['id']}}">{{$region['name']}}</option>
                                @endforeach
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
                    @foreach($masters as $master)
                        <tr>
                            <td>{{$master->name}}</td>
                            <td>{!! $master->service !!}</td>
                            <td>{{$master->area}}</td>
                            <td>{{$master->serviceOrderCount}}</td>
                            <td><a href="">雇佣师傅</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div id="favoritePagination"></div>
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
            elem: 'favoritePagination',
            count: {{$count}}, //数据总数
            curr: {{$page}},
            jump: function (obj) {
                console.log(obj);
                if (!first) {
                    location.href = "/favorite?&page=" + obj.curr + '&limit=' + obj.limit;
                }
                first = false;
            }
        });
    })
</script>
</html>
