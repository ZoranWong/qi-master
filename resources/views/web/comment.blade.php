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
                    <a href="/">首页</a>
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
                    <li class="{{$type === null ? 'layui-this' : ''}}">
                        <a href="/comments">全部</a>
                    </li>
                    <li class="{{$type == \App\Models\MasterComment::TYPE_GOOD?  'layui-this' : ''}}">
                        <a href="/comments?type={{\App\Models\MasterComment::TYPE_GOOD}}">好评</a>
                    </li>
                    <li class="{{$type == \App\Models\MasterComment::TYPE_BAD ?  'layui-this' : ''}}">
                        <a href="/comments?type={{\App\Models\MasterComment::TYPE_BAD}}">差评</a>
                    </li>
                </ul>
                <div class="layui-tab-content" id="comment">
                    <div class="layui-tab-item {{$type === null ?  'layui-show' : ''}}">
                        @foreach($comments as $comment)
                            @include('web.comment_item', ['comment' => $comment])
                        @endforeach
                    </div>
                    <div class="layui-tab-item {{$type == \App\Models\MasterComment::TYPE_GOOD ?  'layui-show' : ''}}">
                        @foreach($comments as $comment)
                            @include('web.comment_item', ['comment' => $comment])
                        @endforeach
                    </div>
                    <div class="layui-tab-item {{$type == \App\Models\MasterComment::TYPE_BAD ?  'layui-show' : ''}}">
                        @foreach($comments as $comment)
                            @include('web.comment_item', ['comment' => $comment])
                        @endforeach
                    </div>
                </div>
                <div id="commentPagination"></div>
            </div>

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
            elem: 'commentPagination',
            count: {{$count}}, //数据总数
            curr: {{$page}},
            jump: function (obj) {
                console.log(obj);
                if (!first) {
                    location.href = "/comments?{{ $type === null ? 'type='.$type : '' }}&page=" + obj.curr + '&limit=' + obj.limit;
                }
                first = false;
            }
        });
    })
</script>
</html>
