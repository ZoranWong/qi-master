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
                        @foreach($comments as $comment)
                            @include('web.comment_item', ['comment' => $comment])
                        @endforeach
                    </div>
                    <div class="layui-tab-item">
                        @foreach($comments as $comment)
                            @include('web.comment_item', ['comment' => $comment])
                        @endforeach
                    </div>
                    <div class="layui-tab-item">
                        @foreach($comments as $comment)
                            @include('web.comment_item', ['comment' => $comment])
                        @endforeach
                    </div>
                </div>
                <div id="pagination"></div>
            </div>

        </div>

    </div>

</div>

<!--content--end-->

</body>
<script>
    layui.use([ 'laypage'], function () {
        let laypage = layui.laypage;
        let first = true;
        laypage.render({
            elem: 'pagination',
            count: {{$count}}, //数据总数
            curr: {{$page}},
            jump: function (obj) {
                console.log(obj);
                if (!first) {
                    location.href = "/orders?{{ $status !== null ? 'status='.$status : '' }}&page=" + obj.curr + '&limit=' + obj.limit;
                }
                first = false;
            }
        });
    })
</script>
</html>
