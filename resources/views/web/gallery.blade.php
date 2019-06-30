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
                <li>商品管理</li>
            </ul>
        </div>
        @include('web.menu')
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
                            <select name="classification_id" lay-filter="">
                                <option value="" selected="">全部</option>
                                @foreach($classifications as $classification)
                                    <option value="{{$classification->id}}">{{$classification->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <button class="layui-btn" lay-submit="" lay-filter="">查询</button>
                    </div>
                    {{--<div class="layui-form-item">--}}
                        {{--<button class="layui-btn" lay-submit="" lay-filter="">批量操作</button>--}}
                    {{--</div>--}}
                </div>
            </form>
            <ul class="template-con">
                @foreach($products as $product)
                    @include('web.product_item', ['product' => $product])
                @endforeach
            </ul>
            <div id="productPagination"></div>
        </div>
    </div>
</div>

<!--content--end-->


{{--<div style="display: none">--}}
<!--upload-->
<div id="template" class="template" style="display: none;">
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
<div id="template-edit" class="template" style="display: none;">
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
{{--</div>--}}

</body>

<script>
    layui.use(['laypage'], function () {
        let laypage = layui.laypage;
        let first = true;
        laypage.render({
            elem: 'productPagination',
            count: {{$count}}, //数据总数
            curr: {{$page}},
            limit: {{$limit}},
            jump: function (obj) {
                console.log(obj);
                if (!first) {
                    location.href = "/gallery?page=" + obj.curr + '&limit=' + obj.limit;
                }
                first = false;
            }
        });
    })
</script>

</html>
