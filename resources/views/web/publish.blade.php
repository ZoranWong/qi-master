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
    <style>
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
            @include('web.publish-step-1', ['classifications' => $classifications])
        </form>
    </div>
</div>
<!--contend end-->

</body>
<script>
</script>
</html>
