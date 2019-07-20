<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="/web/plugin/layui/css/layui.css"/>
    <link rel="stylesheet" href="/web/css/common.css"/>
    <link rel="stylesheet" href="/web/css/styles.css"/>
    <link href="https://cdn.bootcss.com/twitter-bootstrap/4.3.1/css/bootstrap.css" rel="stylesheet">
    <script type="text/javascript" src="/web/js/jquery-3.3.1.js"></script>
    <script type="text/javascript" src="/web/plugin/layui/layui.js"></script>
    <script src="https://cdn.bootcss.com/underscore.js/1.9.1/underscore-min.js"></script>
    <script src="https://cdn.bootcss.com/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <style>
        body{
            background-color: #f2f2f2 !important;
        }
        .schedule {
            display: flex;
            height: 2px;
            background-color: #a7a7a7;
            margin-top: 64px;
            position: relative;
        }
        .schedule .step {
            text-align: center;
            /*margin: 0 32px;*/
            position: absolute;
            transform: translate(-50%, -16px);
        }
        .schedule .step.step-1{
            left: 25%;
        }
        .schedule .step.step-2{
            left: 50%;
        }
        .schedule .step.step-3{
            left: 75%;
        }
        .schedule .step.active p {
            color: #fe8f00;
        }
        .schedule .step.active .schedule-counter {
            border: #fe8f00 2px solid;
            background-color: #fe8f00;
            color: #ffffff;
        }
        .schedule .step p{
            color: #a7a7a7;
        }
        .schedule .step-des{
            margin-top: 6px;
        }
        .schedule .step .schedule-counter {
            height: 32px;
            width: 32px;
            border: #a7a7a7 2px solid;
            border-radius: 100%;
            line-height: 32px;
            margin: auto;
            background-color: #f2f2f2;
        }
        .schedule .schedule-line {
            position: absolute;
            height: 2px;
            background-color: #fe8f00;
        }
        .schedule .schedule-line.step-1{
            width: 25%;
        }
        .schedule .schedule-line.step-2{
            width: 50%;
        }
        .schedule .schedule-line.step-3{
            width: 75%;
        }
        .publish-form {
            top: 64px;
            position: relative;
            /*background-color: #ffffff;*/
            padding-bottom: 32px;
        }
        .step-header {
            background-color: #fbb55b;
            padding: 12px;
            display: flex;
        }

        .step-header div {
            color: #fff;
            font-size: 16px;
        }

        .step-header i {
            font-size: 16px;
        }

        .q-form-group {
            margin-top: 18px;
        }

        .required-icon {
            color: #a83800;
        }

        .q-form-item-left {
            width: 15%;
            text-align: right;
            max-width: 180px;
            min-width: 124px;
            margin-top: 10px;
            height: max-content;
        }

        .q-form-right {
            width: 85%;
            height: max-content;
        }

        .q-form-label span {
            vert-align: middle;
            line-height: 100%;
            display: inline;
            height: 100%;
        }

        .q-form-item {
            background-color: #ffffff;
            border-bottom-left-radius: 4px;
            border-bottom-right-radius: 4px;
            padding-bottom: 32px;
            /*margin-bottom: 12px;*/
        }

        .hidden {
            display: none;
        }
        .selected-icon {
            color: #ffffff;
            position: absolute;
            right: 0;
            text-align: right;
            bottom: 0;
            width: 0;
            height: 0;
            border-style: solid;
            border-width: 0 0 28px 28px;
            border-color: transparent transparent #fe8f00 transparent;
            /*border-bottom-right-radius: 4px;*/
        }

        .selected-icon i.icon {
            position: absolute;
            right: 0;
            bottom: -28px;
        }
        .form-item-module {
            margin-top: 18px;
            padding-top: 32px;
            border-radius: 4px;
        }

        .q-form-btn:hover {
            border: #fe8f00 1px solid;
            color: #fe8f00;
        }
        .step.step-form{
            margin-top: -18px;
        }
    </style>
</head>

<body>
<!--header-->
@include('web.header')

<!--header end-->

<!--content-->
<div class="max-width">
    <div class="layui-box">
        <div class="schedule">
            <div class="schedule-line step-1"></div>
            <div class="step step-1 active">
                <p class="schedule-counter">1</p>
                <p class="step-des">添加服务类目与商品信息</p>
            </div>
            <div class="step step-2">
                <p class="schedule-counter">2</p>
                <p class="step-des">补充详细信息</p>
            </div>
            <div class="step step-3">
                <p class="schedule-counter">3</p>
                <p class="step-des">订单发布成功</p>
            </div>
        </div>
        <form class="layui-form publish-form">
            <div class="step">
                <div class="step-header">
                    <div class="icon">
                        <i class="layui-icon layui-icon-auz"></i>
                    </div>
                    <div>
                        平台提供线上担保交易，保障您的资金安全，且不会收取您任何佣金。80%的带货跑路、漫天加价均由线下交易导致，请勿线下交易。
                    </div>
                </div>
            </div>
            @include('web.publish-step-1', [
            'classifications' => $classifications,
             'productsUrl' => $productsUrl,
              'productUpload' => $productUpload
              ])
            @include('web.publish-step-2')
        </form>
    </div>
</div>
<!--contend end-->

</body>
<script>
    const classifications = {!! $classifications !!};
    const orderInfo = {
        classification_id: classifications[0] ? classifications[0]['id'] :null,
        category_id: null,
        child_category_id: null,
        service_type_id: null,
        products: []
    };
    const productsDict = {};
    $(function () {
        layui.use(['layer', 'form'], function(){
            var layer = layui.layer
                ,form = layui.form;
        });
    });
</script>
</html>
