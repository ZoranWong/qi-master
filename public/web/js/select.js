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
    laydate.render({
        elem: '#selectData',
        range: true
    });


    //联动选择
    categoryJson = [{
        "id": 1,
        "name": "木门类",
        "pid": 0,
        "children": [{
            "id": 5,
            "name": "实木门",
            "pid": 1
        }, {
            "id": 6,
            "name": "复合门",
            "pid": 2
        }]
    },
        {
            "id": 2,
            "name": "铝合金门类",
            "pid": 0,
            "children": [{
                "id": 8,
                "name": "铝合金门",
                "pid": 3
            }, {
                "id": 9,
                "name": "铝合金推拉门",
                "pid": 4
            }]
        },
    ];

    // 创建一个Select
    var createSelect = function (optionData) {
        var html = '';
        html += '<div class="layui-input-block">';
        html += ' <select lay-filter="demo" class = "selectDemo">';
        html += '  <option value="">请选择</option>';
        for (var i = 0; i < optionData.length; i++) {
            html += '  <option value="' + optionData[i].id + '">' + optionData[i].name + '</option>';
        }
        html += ' </select>';
        html += '</div>';
        return html;
    }
    // select容器ID
    var $selectWrap = $('.myselect');
    // 获取当前option的数据
    var getOptionData = function (catData, optionIndex) {
        var item = catData;
        for (var i = 0; i < optionIndex.length; i++) {
            if ('undefined' == typeof item[optionIndex[i]]) {
                item = null;
                break;
            } else if ('undefined' == typeof item[optionIndex[i]]['children']) {
                item = null;
                break;
            } else {
                item = item[optionIndex[i]]['children'];
            }
        }

        return item;
    }

    // 没有默认值
    var html = createSelect(categoryJson);
    // html
    $selectWrap.append(html);
    var index = [];
    for (var i = 0; i < categoryJson.length; i++) {
        $selectWrap.find('select:last').val(i + 1);
        var lastIndex = $selectWrap.find('select:last').get(0).selectedIndex - 1;
        index.push(lastIndex);
        // 取出下级的选项值
        var childItem = getOptionData(categoryJson, index);
        // 下级选项值存在则创建select
        if (childItem) {
            var html = createSelect(childItem);
            $selectWrap.append(html);
        }
    }
    form.render('select');

    // 监听select
    form.on('select(demo)', function (data) {
        var $thisItem = $(data.elem).parent();
        // 移除后面的select
        $thisItem.nextAll('div.layui-input-inline').remove();
        var index = [];
        // 获取所有select，取出选中项的值和索引
        $thisItem.parent().find('select').each(function () {
            index.push($(this).get(0).selectedIndex - 1);
        });
        var childItem = getOptionData(categoryJson, index);
        if (childItem) {
            var html = createSelect(childItem);
            $('body #myselect').append(html);
            form.render('select');
        }
    });


})
