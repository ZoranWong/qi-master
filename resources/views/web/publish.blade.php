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

        .step step-1 .task-txt-left {
            margin-top: 42px;
        }

        .step step-2 .task-txt-left {
            margin-top: 18px;
        }

        .classification.selected,
        .service-type-btn.selected {
            border: #f38752 1px solid;
        }

        .service-classification-list {
            display: flex;
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

        .big-title {
            font-size: 24px;
            font-weight: 400;
            border-left: #f7a881 2px solid;
            padding-left: 12px;
            color: #4a4a4a;
            margin-top: 42px;
        }

        .order-info {
            border-top: #adadad 1px solid;
            margin-top: 12px;
            padding-top: 12px;
            padding-left: 64px;
            width: 100%;
            display: block;
        }

        .publish {
            margin-bottom: 48px;
        }

        .step {
            width: 100%;
            display: flex;
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
            <div class="step step-1">
                <div class="layui-form-item">
                    <div class="layui-form-label"><em class="red-dot">*</em>服务类目：</div>
                    <div class="layui-input-block">
                        <ul class="service-classification-list">
                            @foreach($classifications as $key => $classification)
                                <li class="radiobox classification {{$key === 0 ? 'selected' : ''}}"
                                    data-id="{{$classification->id}}">
                                    <label class="radiobox" style="display: block;">
                                        {{--<input name="classification_id" type="radio" class="radio-input hidden" >--}}
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
            <div class="step step-2">
                <div class="layui-form-item">
                    <div class="layui-form-label">
                        <em class="red-dot">*</em>服务类型：
                    </div>
                    <div class="layui-input-block">
                        @foreach($classifications as $key => $classification)
                            <ul data-id="{{$classification->id}}"
                                class="classification-{{$classification->id}} service-type-list flex {{$key === 0 ? 'selected' : 'hidden'}}">
                                @foreach($classification->serviceTypes as $k => $serviceType)
                                    <li class="radio-box service-type" data-id="{{$serviceType->id}}">
                                        <label class="radio-box" style="display: block;">
                                            {{--<input name="service_type_id" type="radio" class="radio-input"--}}
                                                   {{--value="{{$serviceType->name}}" >--}}
                                            <a data-id="{{$serviceType->id}}"
                                               class="service-type-btn layui-btn layui-btn-primary {{$k === 0 ? 'selected' : ''}}">
                                                {{$serviceType->name}}
                                            </a>
                                        </label>
                                    </li>
                                @endforeach
                            </ul>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="step step-3">
                <div class="layui-form-item">
                    <div class="layui-form-label">
                        <em class="red-dot">*</em>商品图片：
                    </div>
                    <div class="layui-input-block flex">
                        <button class="layui-btn layui-btn-primary">
                            <i class="layui-icon layui-icon-add-circle-fine"></i>
                            选择/上传商品</button>
                    </div>
                </div>
            </div>
            <div class="step step-4">
                <div class="layui-form-item">
                    <div class="layui-form-label">
                        <em class="red-dot">*</em>商品类别：
                    </div>
                    <div class="layui-input-block flex">
                        <select name="city" lay-verify="required">
                            <option value=""></option>
                            <option value="0">北京</option>
                            <option value="1">上海</option>
                            <option value="2">广州</option>
                            <option value="3">深圳</option>
                            <option value="4">杭州</option>
                        </select>
                        <select name="city" lay-verify="required">
                            <option value=""></option>
                            <option value="0">北京</option>
                            <option value="1">上海</option>
                            <option value="2">广州</option>
                            <option value="3">深圳</option>
                            <option value="4">杭州</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="step step-5">
                <div class="layui-form-item">
                    <div class="layui-form-label">
                        <em class="red-dot">*</em>商品型号：
                    </div>
                    <div class="layui-input-block flex">
                        <input type="text" class="layui-input" name="title">
                    </div>
                </div>
            </div>
            <div class="step step-6">
                <div class="layui-form-item">
                    <div class="layui-form-label">
                        <em class="red-dot">*</em>商品数量：
                    </div>
                    <div class="layui-input-block flex">
                        <input type="number" class="layui-input" name="num"/>
                    </div>
                </div>
            </div>
            <div class="step step-7">
                <div class="layui-form-item">
                    <div class="layui-form-label">
                        特殊要求：
                    </div>
                    <div class="layui-input-block flex">
                        <textarea class="layui-textarea"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="big-title">客户信息</div>
        <div class="order-info customer-info">
            <div class="step step-8">
                <div class="layui-form-item">
                    <div class="layui-form-label">
                        <em class="red-dot">*</em>客户姓名：
                    </div>
                    <div class="layui-input-block flex">
                        <input type="text" class="layui-input" name="title">
                    </div>
                </div>
            </div>
            <div class="step step-9">
                <div class="layui-form-item">
                    <div class="layui-form-label">
                        <em class="red-dot">*</em>手机号码：
                    </div>
                    <div class="layui-input-block flex">
                        <input type="text" class="layui-input" name="title">
                    </div>
                </div>
            </div>
            <div class="step step-10">
                <div class="layui-form-item">
                    <div class="layui-form-label">
                        <em class="red-dot">*</em>所在区域：
                    </div>
                    <div class="layui-input-block flex">
                        <input type="text" class="layui-input" name="title">
                    </div>
                </div>
            </div>
            <div class="step step-11">
                <div class="layui-form-item">
                    <div class="layui-form-label">
                        <em class="red-dot">*</em>详细地址：
                    </div>
                    <div class="layui-input-block flex">
                        <input type="text" class="layui-input" name="title">
                    </div>
                </div>
            </div>
        </div>
        <div class="big-title">其他信息</div>
        <div class="order-info other-info">
            <div class="step step-12">
                <div class="layui-form-item">
                    <div class="layui-form-label">
                        <em class="red-dot">*</em>期望时间：
                    </div>
                    <div class="layui-input-block flex">
                        <input type="text" class="layui-input" name="title">
                    </div>
                </div>
            </div>
            <div class="step step-13">
                <div class="layui-form-item">
                    <div class="layui-form-label">
                        <em class="red-dot">*</em>备注：
                    </div>
                    <div class="layui-input-block flex">
                        <input type="text" class="layui-input" name="title">
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
    var classifications = {!! $classifications !!};
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
    layui.use('form', function(){
        var form = layui.form;
        //监听提交
        form.on('submit(formDemo)', function(data){
            layer.msg(JSON.stringify(data.field));
            return false;
        });
    });
</script>

</html>
