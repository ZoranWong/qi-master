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
                                <option value="" selected="">上海</option>
                                <option value="0">合肥</option>
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
                    <tr>
                        <td>张祖良</td>
                        <td>家具(配送/搬运/安装/维修)</td>
                        <td>昆明</td>
                        <td>3</td>
                        <td><a href="">雇佣师傅</a></td>
                    </tr>
                    <tr>
                        <td>张祖良</td>
                        <td>家具(配送/搬运/安装/维修)</td>
                        <td>昆明</td>
                        <td>1</td>
                        <td><a href="">雇佣师傅</a></td>
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
