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
                    <a href="/">首页</a>
                </li>
                <li>
                    <a href=""></a> <span class="separator">&gt;</span>
                </li>
                <li>钱包余额</li>
            </ul>
        </div>
        @include('web.menu')

        <div class="right-content" style="margin-bottom: 10px;">
            <h2>钱包余额</h2>
            <div class="bottom clearfix">
                <div class="balance fl">
                    <span class="txt">可用余额（元）</span>
                    <span class="money">2019.70</span>
                    <div>
                        <a href="{{route("user.charge")}}">充值</a>
                    </div>
                </div>
                <div class="account-info  fr">
                    <ul class="clearfix">
                        <li>
                            <span>0.00</span>
                            <span>今日合计（元）</span>
                        </li>
                        <li>
                            <span>0.00</span>
                            <span>本周合计（元）</span>
                        </li>
                        <li>
                            <span>0.00</span>
                            <span>本月合计（元）</span>
                        </li>
                        <li>
                            <span>0.00</span>
                            <span>上月合计（元）</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="right-content">
            <h3>交易记录查询</h3>
            <div class="layui-form float-none">
                <div class="layui-form-item">
                    <label class="layui-form-label">资金流向</label>
                    <div class="layui-input-block radio-style">
                        <input type="radio" name="flowType" value="全部" title="全部" checked="">
                        <input type="radio" name="flowType" value="收入" title="收入">
                        <input type="radio" name="flowType" value="支出" title="支出">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">交易类型</label>
                    <div class="layui-input-block radio-style">
                        <input type="radio" name="trackType" value="全部" title="全部" checked="">
                        <input type="radio" name="trackType" value="在线充值" title="在线充值">
                        <input type="radio" name="trackType" value="订单付款" title="订单付款">
                        <input type="radio" name="trackType" value="订单退款" title="订单退款">
                        <input type="radio" name="trackType" value="售后付款" title="售后付款">
                        <input type="radio" name="trackType" value="增加费用" title="增加费用">
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-inline">
                        <label class="layui-form-label">交易时间</label>
                        <div class="layui-input-inline date-width">
                            <input type="text" class="layui-input" id="selectData" placeholder=" 开始日期-结束日期 ">
                        </div>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">订单编号</label>
                    <div class="layui-input-inline date-width">
                        <input type="text" name="username" lay-verify="required" placeholder="请输入订单号" autocomplete="off"
                               class="layui-input">
                    </div>
                </div>

                <div class="layui-form-item">
                    <button class="layui-btn inquire" lay-submit="" lay-filter="">查询</button>
                    <button class="layui-btn" lay-submit="" lay-filter="">导出</button>
                </div>
            </div>

            <div class="layui-form table-form">
                <table class="layui-table">
                    <thead>
                    <tr>
                        <th>流水号</th>
                        <th>对应订单号</th>
                        <th>发生时间</th>
                        <th>类型</th>
                        <th>收支（元）</th>
                        <th>账户余额（元）</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>L293031389329494016</td>
                        <td>S2190310130131621</td>
                        <td>2019-03-20 17:00:41</td>
                        <td>支付（订单）</td>
                        <td class="f-green">-200.00</td>
                        <td>2019.70</td>

                    </tr>
                    <tr>
                        <td>L293031389329494016</td>
                        <td>S2190310130131621</td>
                        <td>2019-03-20 17:00:41</td>
                        <td>支付（订单）</td>
                        <td class="f-green">-200.00</td>
                        <td>2019.70</td>
                    </tr>
                    <tr>
                        <td>L293031389329494016</td>
                        <td>S2190310130131621</td>
                        <td>2019-03-20 17:00:41</td>
                        <td>在线充值</td>
                        <td class="f-yellow">+200.00</td>
                        <td>2019.70</td>
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
