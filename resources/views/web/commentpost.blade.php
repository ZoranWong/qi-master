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
                <li>
                    <a href="comment.html">评价管理</a> <span class="separator">&gt;</span>
                </li>
                <li>评价订单</li>
            </ul>
        </div>
        @include('web.menu')
        <div class="right-content">
            <h2>订单评价</h2>
            <div class="refund-order border-color">
                <h3>订单信息</h3>
                <ul>
                    <li>
                        <span>订单编号：</span>
                        <span>P10658972787</span>
                    </li>
                    <li>
                        <span>服务商：</span>
                        <span>李青生</span>
                    </li>
                    <li>
                        <span>下单时间：</span>
                        <span>2019-03-21 09:11</span>
                    </li>
                </ul>
            </div>

            <div class="layui-form float-none order-comment">
                <div class="layui-form-item">
                    <label class="layui-form-label">综合评分</label>
                    <div class="layui-input-block radio-style">
                        <input type="radio" name="grade" value="好评" title="好评" checked="">
                        <input type="radio" name="grade" value="中评" title="中评">
                        <input type="radio" name="grade" value="差评" title="差评">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">整体印象</label>
                    <div class="layui-input-block radio-style">
                        <input type="checkbox" name="impre" value="认真负责" title="认真负责" checked="">
                        <input type="checkbox" name="impre" value="技术不错" title="技术不错">
                        <input type="checkbox" name="impre" value="服务态度好" title="服务态度好">
                        <input type="checkbox" name="impre" value="上门时间准时" title="上门时间准时">
                        <input type="checkbox" name="impre" value="随意加价" title="随意加价">
                        <input type="checkbox" name="impre" value="价格合适" title="价格合适">
                        <input type="checkbox" name="impre" value="维修水平高" title="维修水平高">
                        <input type="checkbox" name="impre" value="安装速度快" title="安装速度快">
                        <input type="checkbox" name="impre" value="做事拖沓" title="做事拖沓">
                        <input type="checkbox" name="impre" value="不按时上门服务" title="不按时上门服务">
                    </div>
                </div>
                <div class="layui-form-item my-rate">
                    <label class="layui-form-label">服务质量</label>
                    <div class="rate"></div>
                </div>
                <div class="layui-form-item my-rate">
                    <label class="layui-form-label">服务态度</label>
                    <div class="rate"></div>
                </div>
                <div class="layui-form-item my-rate">
                    <label class="layui-form-label">服务速度</label>
                    <div class="rate"></div>
                </div>
                <div class="layui-form-item">
                    <div class="text">具体评价一下服务商在此任务中的表现（5字-100字）</div>
                    <div class="layui-input-inline">
                        <textarea placeholder="您对服务商在本次服务中的表现还满意吗？" class="layui-textarea"></textarea>
                    </div>
                </div>
                <div class="layui-form-item">
                    <button class="layui-btn inquire" lay-submit="" lay-filter="">提交</button>
                </div>

            </div>

        </div>

    </div>

</div>

<!--content--end-->

</body>

</html>
