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
        li.radio-box {
            margin: 6px;
        }

        .hidden {
            display: none;
        }

        .step-1 .task-txt-left {
            margin-top: 42px;
        }

        .step-2 .task-txt-left {
            margin-top: 18px;
        }

        .classification.selected,
        .service-type-btn.selected {
            border: #f38752 1px solid;
        }

        .service-classification-list li {
            float: left;
            width: 90px;
            height: 90px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-right: 20px;
            margin-bottom: 12px;
            text-align: center;
            cursor: pointer;
            position: relative;
            transition: .2s ease-out;
            -moz-transition: .15s ease-out;
            font-size: 14px;
        }

        .service-classification-list li .radiobox {
            width: 100%;
            height: 100%;
            margin: 0;
            cursor: pointer;
        }

        .service-classification-list li .radiobox input {
            display: none;
        }

        li.classification img.classification-icon {
            margin-top: 8px;
            width: 52%;
            height: auto;
        }
        .big-title{
            font-size: 24px;
            font-weight: 400;
            border-left: #f7a881 2px solid;
            padding-left: 12px;
            color: #4a4a4a;
            margin-top: 42px;
        }
        .order-info{
            border-top: #adadad 1px solid;
            margin-top: 12px;
            padding-top: 12px;
            padding-left: 24px;
        }
        .publish{
            margin-bottom: 48px;
        }
        .order-info{
            display: grid;
        }
    </style>
</head>

<body>
<!--header-->
@include('web.header')

<!--header end-->

<!--content-->
<div class="max-width">
    <form class="publish layui-form">
        <div class="big-title">商品信息</div>
        <div class="order-info product-info">
            <div class="step-1 layui-form-item">
                <div class="task-section clearfix">
                    <label class="fl layui-form-label">
                        <p class="task-txt-left">
                        <span>
                            <em class="red-dot">*</em>服务类目：
                        </span>
                        </p>
                    </label>
                    <div class="layui-input-block">
                        <ul class="service-classification-list">
                            @foreach($classifications as $key => $classification)
                                <li class="radiobox classification {{$key === 0 ? 'selected' : ''}}"
                                    data-id="{{$classification->id}}">
                                    <label class="radiobox" style="display: block;">
                                        <input name="classification_id" type="radio" class="radio-input">
                                        <div style="width: 100%;margin-top: 8px;">
                                            <span>{{$classification->name}}</span>
                                        </div>
                                        <img class="classification-icon" src="{{$classification->iconUrl}}">
                                    </label>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="step-2 layui-form-item">
                <div class="task-section clearfix">
                    <div class="fl layui-form-label">
                        <p class="task-txt-left">
                        <span>
                            <em class="red-dot">*</em>服务类型：
                        </span>
                        </p>
                    </div>
                    <div class="layui-input-block">
                        @foreach($classifications as $key => $classification)
                            <ul data-id="{{$classification->id}}"
                                class="classification-{{$classification->id}} service-type-list flex {{$key === 0 ? 'selected' : 'hidden'}}">
                                @foreach($classification->serviceTypes as $k => $serviceType)
                                    <li class="radio-box service-type" data-id="{{$serviceType->id}}">
                                        <label class="radio-box" style="display: block;">
                                            <input name="service_type_id" type="radio" class="radio-input"
                                                   value="{{$serviceType->name}}">
                                            <button data-id="{{$serviceType->id}}"
                                                    class="service-type-btn layui-btn layui-btn-primary {{$k === 0 ? 'selected' : ''}}">
                                                {{$serviceType->name}}
                                            </button>
                                        </label>
                                    </li>
                                @endforeach
                            </ul>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="step-3 layui-form-item">
                <div class="task-section clearfix">
                    <div class="fl">
                        <p class="task-txt-left">
                        <span>
                            <em class="red-dot">*</em>商品图片：
                        </span>
                        </p>
                    </div>
                    <div class="layui-from-item">
                        <div class="">

                        </div>
                    </div>
                </div>
            </div>
            <div class="step-4 layui-form-item">
                <div class="task-section clearfix">
                    <div class="fl">
                        <p class="task-txt-left">
                        <span>
                            <em class="red-dot">*</em>商品类别：
                        </span>
                        </p>
                    </div>
                    <div class="layui-from-item">
                        <div class="">

                        </div>
                    </div>
                </div>
            </div>
            <div class="step-5 ">
                <div class="layui-form-item">
                    <div class="fl layui-form-label">
                        <p class="task-txt-left">
                        <span>
                            <em class="red-dot">*</em>商品型号：
                        </span>
                        </p>
                    </div>
                    <div class="layui-input-block">
                        <input class="product-title" type="text">
                    </div>
                </div>
            </div>
            <div class="step-6">
                <div class="task-section clearfix">
                    <div class="fl">
                        <p class="task-txt-left">
                        <span>
                            <em class="red-dot">*</em>商品数量：
                        </span>
                        </p>
                    </div>
                    <div class="">
                        <div class="">

                        </div>
                    </div>
                </div>
            </div>
            <div class="step-7">
                <div class="task-section clearfix">
                    <div class="fl">
                        <p class="task-txt-left">
                        <span>
                            <em class="red-dot"></em>特使要求：
                        </span>
                        </p>
                    </div>
                    <div class="layui-from-item">
                        <div class="">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="big-title">客户信息</div>
        <div class="order-info customer-info">
            <div class="step-8">
                <div class="task-section clearfix">
                    <div class="fl">
                        <p class="task-txt-left">
                        <span>
                            <em class="red-dot">*</em>客户姓名：
                        </span>
                        </p>
                    </div>
                    <div class="layui-from-item">
                        <div class="">

                        </div>
                    </div>
                </div>
            </div>
            <div class="step-9">
                <div class="task-section clearfix">
                    <div class="fl">
                        <p class="task-txt-left">
                        <span>
                            <em class="red-dot">*</em>手机号码：
                        </span>
                        </p>
                    </div>
                    <div class="layui-from-item">
                        <div class="">

                        </div>
                    </div>
                </div>
            </div>
            <div class="step-10">
                <div class="task-section clearfix">
                    <div class="fl">
                        <p class="task-txt-left">
                        <span>
                            <em class="red-dot">*</em>所在区域：
                        </span>
                        </p>
                    </div>
                    <div class="layui-from-item">
                        <div class="">

                        </div>
                    </div>
                </div>
            </div>
            <div class="step-11">
                <div class="task-section clearfix">
                    <div class="fl">
                        <p class="task-txt-left">
                        <span>
                            <em class="red-dot">*</em>详细地址：
                        </span>
                        </p>
                    </div>
                    <div class="layui-from-item">
                        <div class="">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="big-title">其他信息</div>
        <div class="order-info other-info">
            <div class="step-12">
                <div class="task-section clearfix">
                    <div class="fl">
                        <p class="task-txt-left">
                        <span>
                            <em class="red-dot">*</em>期望时间：
                        </span>
                        </p>
                    </div>
                    <div class="layui-from-item">
                        <div class="">

                        </div>
                    </div>
                </div>
            </div>
            <div class="step-13">
                <div class="task-section clearfix">
                    <div class="fl">
                        <p class="task-txt-left">
                        <span>
                            <em class="red-dot">*</em>备注：
                        </span>
                        </p>
                    </div>
                    <div class="layui-from-item">
                        <div class="">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="layui-form-item">

        </div>
    </form>
</div>
<!--contend end-->

</body>

<script>
    $(function () {
        $('.service-classification-list li.classification').click(function () {
            $('.service-classification-list li.classification.selected').removeClass('selected');
            $(this).addClass('selected');
            $('.service-type-list').addClass('hidden')
            let id = $(this).data('id');
            $(`.service-type-list.classification-${id}`).removeClass('hidden');
        });
        $('.service-type-btn').click(function () {
            $('.service-type-btn.selected').removeClass('selected');
            $(this).addClass('selected');
        });
    });
</script>

</html>
