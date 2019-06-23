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

                <li>订单管理</li>
            </ul>
        </div>
        @include('web.menu')
        <div class="right-content">
            <h2>订单中心</h2>
            <div class="layui-tab">
                <ul class="layui-tab-title">
                    <li class="layui-this">全部</li>
                    <li>待付款</li>
                    <li>待雇佣</li>
                    <li>待验收</li>
                    <li>待评价</li>
                </ul>
                <div class="layui-form float-none">
                    <div class="layui-form-item">
                        <label class="layui-form-label">订单标记</label>
                        <div class="layui-input-block radio-style">
                            <input type="radio" name="fee" value="全部" title="全部" checked="">
                            <input type="radio" name="fee" value="申请空跑费" title="申请空跑费">
                            <input type="radio" name="fee" value="增加费用" title="增加费用">
                            <input type="radio" name="fee" value="申请退款" title="申请退款">
                            <input type="radio" name="fee" value="申请售后" title="申请售后">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">订单日期</label>
                        <div class="layui-input-block radio-style">
                            <input type="radio" name="date" value="全部" title="全部" checked="">
                            <input type="radio" name="date" value="在线充值" title="近一个月">
                            <input type="radio" name="date" value="订单付款" title="近三个月">
                            <input type="radio" name="date" value="订单退款" title="近六个月">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <div class="layui-inline">
                            <label class="layui-form-label">下单时间</label>
                            <div class="layui-input-inline date-width">
                                <input type="text" class="layui-input" id="selectData" placeholder=" 开始日期-结束日期 ">
                            </div>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">客户信息</label>
                        <div class="layui-input-inline date-width">
                            <input type="text" name="username" lay-verify="required" placeholder="请输入客户姓名或手机号"
                                   autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">订单编号</label>
                        <div class="layui-input-inline date-width">
                            <input type="text" name="ordernum" lay-verify="required" placeholder="请输入订单号"
                                   autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <button class="layui-btn inquire" lay-submit="" lay-filter="">查询</button>
                    </div>
                </div>
                <div class="layui-tab-content order">
                    <div class="layui-tab-item layui-show">
                        <div class="layui-form">
                            <table class="layui-table">
                                <thead>
                                <tr>
                                    <th colspan="6">
                                        <span>订单号：P10434789148</span>
                                        <span>2019-01-17 13:34:04</span>
                                        <span>服务商：黄锋（18260098365）</span>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        <div class="flex">
                                            <div class="item-img">
                                                <img src="/web/image/product.jpg">
                                            </div>
                                            <div class="item-text">
                                                <span>衣柜</span>
                                                <span>两门小衣柜</span>
                                                <span>数量：1</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            <div>周金梅/13864666439</div>
                                            <div>山东省潍坊市寒亭区大家洼街道八里村小5号楼2单元302</div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            <div>已有<em class="red">1</em>位师傅报价</div>
                                            <div>最低价<em class="red">159.00</em></div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-center">待雇佣</div>
                                    </td>
                                    <td>
                                        <div class="more text-center">
                                            <a href="/orders/1">查看订单</a>
                                            <a href="">雇佣师傅</a>
                                            <span>取消订单</span>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>


                    <div class="layui-tab-item">待付款</div>


                    <div class="layui-tab-item">待雇佣</div>

                    <!--待验收-->
                    <div class="layui-tab-item">
                        <div class="layui-form">
                            <table class="layui-table">
                                <thead>
                                <tr>
                                    <th colspan="6">
                                        <span>订单号：P10434789148</span>
                                        <span>2019-01-17 13:34:04</span>
                                        <span>服务商：黄锋（18260098365）</span>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        <div class="flex">
                                            <div class="item-img">
                                                <img src="/web/image/product.jpg">
                                            </div>
                                            <div class="item-text">
                                                <span>衣柜</span>
                                                <span>两门小衣柜</span>
                                                <span>数量：1</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            <div>周金梅/13864666439</div>
                                            <div>山东省潍坊市寒亭区大家洼街道八里村小5号楼2单元302</div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            <div class="head-img">
                                                <img src="/web/image/head.jpg">
                                            </div>
                                            <div>何金明</div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            <div>服务完成</div>
                                            <div>￥159.00</div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="more text-center">
                                            <a href="orderinfo.html">查看订单</a>
                                            <a href="">确认验收</a>
                                            <a href="refundcreate.html">申请退款</span>
                                        </div>

                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!--待验收end-->


                    <!--待评价-->
                    <div class="layui-tab-item">
                        <div class="layui-form">
                            <table class="layui-table">
                                <thead>
                                <tr>
                                    <th colspan="6">
                                        <span>订单号：P10434789148</span>
                                        <span>2019-01-17 13:34:04</span>
                                        <span>服务商：黄锋（18260098365）</span>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        <div class="flex">
                                            <div class="item-img">
                                                <img src="/web/image/product.jpg">
                                            </div>
                                            <div class="item-text">
                                                <span>衣柜</span>
                                                <span>两门小衣柜</span>
                                                <span>数量：1</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            <div>周金梅/13864666439</div>
                                            <div>山东省潍坊市寒亭区大家洼街道八里村小5号楼2单元302</div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            <div class="head-img">
                                                <img src="/web/image/head.jpg">
                                            </div>
                                            <div>何金明</div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            <div>交易成功</div>
                                            <div>￥159.00</div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="more text-center">
                                            <a href="orderinfo.html">查看订单</a>
                                            <a href="commentpost.html">立即评价</span>
                                        </div>

                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!--待评价end-->
                </div>

            </div>

        </div>

    </div>

</div>

<!--content--end-->

</body>

</html>
<script>
    layui.use(['form', 'layedit', 'laydate', 'laypage', 'element'], function () {
        var form = layui.form,
            layer = layui.layer,
            layedit = layui.layedit,
            laydate = layui.laydate;
        element = layui.element;
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
