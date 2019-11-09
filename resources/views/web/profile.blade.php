<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>会员中心-我的账户</title>
    <link rel="stylesheet" href="/web/plugin/layui/css/layui.css"/>
    <link rel="stylesheet" href="/web/css/common.css"/>
    <link rel="stylesheet" href="/web/css/styles.css"/>
    <script type="text/javascript" src="/web/js/jquery-3.3.1.js"></script>
    {{--<script src="https://cdn.bootcss.com/jquery/1.7/jquery.min.js"></script>--}}
    <script type="text/javascript" src="/web/plugin/layui/layui.js"></script>
    <script type="text/javascript" src="/web/js/common.js"></script>
    <script type="text/javascript" src="/web/js/layuicom.js"></script>
    <script type="text/javascript" src="/web/plugin/pccity/js/bootstrap.min.js"></script>
    {{--<script type="text/javascript" src="/web/plugin/pccity/js/distpicker.data.js"></script>--}}
    {{--<script type="text/javascript" src="/web/plugin/pccity/js/distpicker.js"></script>--}}
    <script src="https://cdn.bootcss.com/distpicker/2.0.5/distpicker.js"></script>
    {{--<script src="https://cdn.bootcss.com/distpicker/1.0.4/distpicker.data.min.js"></script>--}}
    {{--<script src="https://cdn.bootcss.com/distpicker/1.0.4/distpicker.min.js"></script>--}}
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
                <li>基本资料</li>
            </ul>
        </div>
        @include('web.menu')
        <div class="right-content">
            <h2>基本资料</h2>
            <div>
                <form class="layui-form float-none profile" action="" onsubmit="return false">
                    <div class="layui-form-item modify-head-img">
                        <label class="layui-form-label">头像</label>
                        <div class="layui-input-inline">
                            <div class="upload-head-img">
                                <img src="{{$user->avatarUrl}}" id="headimg">
                                <input name="avatar" type="hidden" >
                                <input name="avatarBtn" type="file" accept="image/*" id="upload-head-img">
                            </div>
                        </div>
                    </div>
                    <div class="layui-form-item" style="margin-top: 65px;">
                        <label class="layui-form-label">用户名</label>
                        <div class="layui-input-inline">
                            <input type="text" name="name" lay-verify="title" autocomplete="off" placeholder="{{$user->name}}"
                                   class="layui-input disabled" value="{{$user->name}}" disabled>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">姓名</label>
                        <div class="layui-input-inline">
                            <input type="text" name="real_name" lay-verify="title" autocomplete="off" placeholder="{{$user->realName}}"
                                   class="layui-input" value="{{$user->realName}}">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">性别</label>
                        <div class="layui-input-block">
                            <input type="radio" name="sex" value="{{\App\Models\User::SEX_UNKNOWN}}" title="保密"
                                {{$user->sex === \App\Models\User::SEX_UNKNOWN ? 'checked' : ''}}>
                            <input type="radio" name="sex" value="{{\App\Models\User::SEX_MALE}}" title="男"
                                {{$user->sex === \App\Models\User::SEX_MALE ? 'checked' : ''}}>
                            <input type="radio" name="sex" value="{{\App\Models\User::SEX_FEMALE}}" title="女"
                                {{$user->sex === \App\Models\User::SEX_FEMALE ? 'checked' : ''}}>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">所在地区</label>
                        <div class="layui-input-flex" data-toggle="distpicker"  data-autoselect="3">
                            <select lay-filter="a" id="a" name="province"></select>
                            <select lay-filter="b" id="b" name="city"></select>
                            <select lay-filter="c" id="c" name="area"></select>
                        </div>
                    </div>
                    <div class="layui-form-item layui-form-text">
                        <label class="layui-form-label">详细地址</label>
                        <div class="layui-input-inline">
                            <textarea name= "address" placeholder="请输入详细地址" class="layui-textarea" value="{{$user->address}}">
                                {{$user->address}}
                            </textarea>
                        </div>
                    </div>
                    <div class="layui-form-item" style="margin-left: 13px;">
                        <button class="layui-btn inquire" lay-submit lay-filter="*">保存</button>
                    </div>
                </form>
            </div>

        </div>

    </div>

</div>

<!--content--end-->

</body>

</html>
<script>
    layui.use(['form'], function () {
        var $ = layui.$
            , form = layui.form;

        form.on('select(a)', function (data) {
            $("#a").val(data.value).change();
            form.render();
        })

        form.on('select(b)', function (data) {
            $("#b").val(data.value).change();
            form.render();
        })

        form.on('select(c)', function (data) {
            $("#c").val(data.value).change();
            form.render();
        })
        form.on("submit(*)", function (formData) {
            let data = formData.field;
            delete data['avatarBtn'];
            data['token'] = "{{$token}}";
            $.ajax({
                url:"{{api_route('user.profile.update')}}",
                data: data,
                method: 'PUT',
                success(){
                    location.reload();
                }
            });
            return false;
        });
    })
    //上传头像
    $(function () {
        $("#upload-head-img").change(function () {
            var $file = $(this);
            var fileObj = $file[0];
            var windowURL = window.URL || window.webkitURL;
            var dataURL;
            var $img = $("#headimg");
            if (fileObj && fileObj.files && fileObj.files[0]) {
                dataURL = windowURL.createObjectURL(fileObj.files[0]);
                $img.attr('src', dataURL);
                uploadFiles(fileObj.files[0], 'files', "{{api_route('upload.file')}}", function (data) {
                    $('input[name="avatar"]').val(data['paths'][0]);
                }, function () {

                });
            } else {
                dataURL = $file.val();
                var imgObj = document.getElementById("headimg");　　　　　　　　 // 1、在设置filter属性时，元素必须已经存在在DOM树中，动态创建的Node，也需要在设置属性前加入到DOM中，先设置属性再加入，无效；
                // 2、src属性需要像下面的方式添加，上面的两种方式添加，无效；

                imgObj.style.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale)";
                imgObj.filters.item("DXImageTransform.Microsoft.AlphaImageLoader").src = dataURL;
            }
        });

    })
</script>
