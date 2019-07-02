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
</head>

<body>
<!--header-->
@include('web.header')

<!--header end-->

<!--content-->
<div class="max-width">
    <div class="publish">
        <div class="step-1">
            <div class="task-section clearfix">
                <div class="fl">
                    <p class="task-txt-left"><span><em class="red-dot">*</em>服务类目：</span></p>
                </div>
                <ul class="serve-category-list">
                    @foreach($classifications as $classification)
                        <li class="radiobox">
                            <label class="radiobox" style="display: block;">
                                <input type="radio" class="radio-input">
                                <div style="width: 100%;margin-top: 8px;">
                                    <span>{{$classification->name}}</span>
                                </div>
                                <img src="{{$classification->iconUrl}}" style="margin-top:8px;width: 60%; height: auto;">
                                <em class="tTrue"></em>
                            </label>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
<!--contend end-->

</body>

</html>
