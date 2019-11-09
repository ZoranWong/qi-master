<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title></title>
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
    <div class="max-width">
        <div class="crumbs">
            <ul class="clearfix">
                <li>您的位置：</li>
                <li>
                    <a href="index.html">首页</a>
                </li>
                <li>
                    <a href=""></a> <span class="separator">&gt;</span>
                </li>
                <li>账户充值</li>
            </ul>
        </div>
        <div class="pay">
            <form class="clearfix">
                <div class="clearfix item">
                    <label class="layui-form-label">充值金额</label>
                    <ul class="select-money">
                        <li class="recharge-fee active" data-value="500">500<input type="hidden" value="500"/></li>
                        <li class="recharge-fee" data-value="1000">1000 <input type="hidden" value="1000"/></li>
                        <li class="recharge-fee" data-value="1500">1500 <input type="hidden" value="1500"/></li>
                        <li class="recharge-money recharge-fee"><input type="text" placeholder="请输入充值金额" class="input"></li>
                    </ul>

                </div>
                <div class="item">
                    <label class="layui-form-label">支付方式</label>
                    <ul class="select-method clearfix">
                        <li class="active pay-type" data-type="0">
                            <i class="alipay"></i>
                            <input type="hidden" value="{{\App\Models\PaymentOrder::PAY_TYPE_AL}}">
                            支付宝
                        </li>
                        <li class="pay-type" data-type="1">
                            <i class="wechat"></i>
                            <input type="hidden" value="{{\App\Models\PaymentOrder::PAY_TYPE_WX}}">
                            微信
                        </li>
                    </ul>
                </div>
                <div class="layui-form-item">
                    <button class="layui-btn inquire" lay-submit="" lay-filter="*">立即充值</button>
                </div>
            </form>
        </div>

    </div>
</div>
<!--content end-->
</body>
<script>
    let data = {
        charge_amount: 500,
        pay_type: 0
    };

    $(function () {
        layui.use(['form'], function () {
            let form = layui.form;
            form.on("submit(*)", function (formData) {
                data['charge_amount'] = $(".recharge-fee.active input").val();
                data['pay_type'] = $(".pay-type.active input").val();
                {{--data['token'] = "{{$token}}";--}}
                window.open(`{{route('user.charge.pay')}}?charge_amount=${data['charge_amount']}&
                pay_type=${data['pay_type']}`);
                return false;
            });
        });
    });
    $(".select-method li").click(function () {
        var index = $(this).index()
        $(".select-method li").removeClass("active")
        $(".select-method li:eq(" + index + ")").addClass("active")
        data['pay_type'] = $(this).data('type');

    })

    $(".select-money li").click(function () {
        var index = $(this).index()
        $(".select-money li").removeClass("active")
        $(".select-money li:eq(" + index + ")").addClass("active")
        data['charge_amount'] = $(this).data('value');
    });

</script>

</html>
