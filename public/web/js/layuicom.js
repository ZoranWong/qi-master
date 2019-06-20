//layui通用js
layui.use(['form', 'layedit', 'laydate', 'laypage', 'element', 'rate', 'layer', 'table', 'upload'], function () {
    var form = layui.form;
    layer = layui.layer;
    layedit = layui.layedit,
        laydate = layui.laydate;
    element = layui.element;
    laypage = layui.laypage;
    rate = layui.rate;
    table = layui.table;
    upload = layui.upload;
    //日期
    lay('.date').each(function () {
        laydate.render({
            elem: this,
            trigger: 'click'
        });
    });

    //营业执照显示与否
    form.on('radio(genre)', function (data) {
        //console.log(this.checked);
        //console.log(data.value)
        if (data.value == '多证合一营业执照') {
            $(".enter-normal").addClass('hide')
        } else if (data.value == '普通营业执照') {
            $(".enter-normal").removeClass('hide')
        }
    });

    //身份证长期
    form.on('checkbox(idinfo)', function (data) {
        console.log(this.checked)
        if (this.checked == true) {
            $(".end-date-2").removeClass('hide')
            $(".end-date-1").addClass('hide')
            return
        }
        if (this.checked == false) {
            $(".end-date-2").addClass('hide')
            $(".end-date-1").removeClass('hide')
        }
    });

    laydate.render({
        elem: '#validity'
    });

    laydate.render({
        elem: '#selectData',
        range: true
    });

    //页数
    laypage.render({
        elem: 'pagination',
        count: 70, //数据总数
        jump: function (obj) {
            //console.log(obj)
        }
    });

    //评分
    layui.each($('.rate'), function (index, elem) {
        rate.render({
            elem: elem,
            value: 1.5,
            half: true,
            text: true,
            setText: function (value) {
                this.span.text(value);
            }
        })
    });
    //多图上传

    //上传商品图片
    var active = {
        offset: function (othis) {
            var type = othis.data('type'),
                text = othis.text();
            layer.open({
                type: 1,
                title: '上传商品图片',
                area: ['520px', 'auto'],
                offset: type,
                content: $("#template"),
                btn: '提交',
                btnAlign: 'c',
                shade: 0.8,
                yes: function () {
                    layer.closeAll();
                }
            });
        }
    }

    $('.upload').on('click', function () {
        var othis = $(this),
            method = othis.data('method');
        active[method] ? active[method].call(this, othis) : '';
    });

    //编辑商品图片

    var edit = {
        offset: function (othis) {
            var type = othis.data('type'),
                text = othis.text();
            layer.open({
                type: 1,
                title: '编辑商品图片',
                area: ['520px', 'auto'],
                offset: type,
                content: $("#template-edit"),
                btn: '保存',
                btnAlign: 'c',
                shade: 0.8,
                yes: function () {
                    layer.closeAll();
                }
            });
        }
    }

    $('.edit').on('click', function () {
        var othis = $(this),
            method = othis.data('method');
        edit[method] ? edit[method].call(this, othis) : '';
    });

})
