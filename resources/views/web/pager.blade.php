<script>
    layui.use(['form', 'layedit', 'laydate', 'laypage', 'element'], function () {
        var form = layui.form,
            layer = layui.layer,
            layedit = layui.layedit,
            laydate = layui.laydate;
        element = layui.element;
        laypage = layui.laypage;
        let search = {};
        laydate.render({
            elem: '#selectData',
            range: true
        });
        let first = true;
        laypage.render({
            elem: 'pagination',
            count: {{$count}}, //数据总数
            curr: {{$page}},
            limit: {{$limit}},
            jump: function (obj) {
                console.log(obj);
                if (!first) {
                    jump(search, obj.curr);
                    location.href = "/orders?{{ $status !== null ? 'status='.$status : '' }}&page=" + obj.curr + '&limit=' + obj.limit;
                }
                first = false;
            }
        });

        function jump(data, page = 1) {
            let url = "/orders?{{ $status !== null ? 'status='.$status : '' }}&limit={{$limit}}&page=" + page;
            for (let key in data.field) {
                let value = data.field[key];
                if (value) {
                    url += `&${key}=${value}`;
                }
            }
            location.href = url;
        }

        form.on('submit(search)', function (data) {
            console.log(data);
            search = data;
            jump(data);
        });
    });
</script>
