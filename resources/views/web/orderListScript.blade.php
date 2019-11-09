@include("web.orderPayTypeScript")
<script>
    layui.use(['form', 'layedit', 'laydate', 'laypage', 'element'], function () {
        var form = layui.form,
            layer = layui.layer,
            layedit = layui.layedit,
            laydate = layui.laydate;
        element = layui.element;
        laypage = layui.laypage;
        let search = {};
        {{--laydate.render({--}}
            {{--elem: '#selectData',--}}
            {{--range: true--}}
        {{--});--}}
        {{--let first = true;--}}
        {{--laypage.render({--}}
            {{--elem: 'pagination',--}}
            {{--count: {{$count}}, //数据总数--}}
            {{--curr: {{$page}},--}}
            {{--limit: {{$limit}},--}}
            {{--jump: function (obj) {--}}
                {{--console.log(obj);--}}
                {{--if (!first) {--}}
                    {{--jump(search, obj.curr);--}}
                    {{--location.href = "/orders?{{ $status !== null ? 'status='.$status : '' }}&page=" + obj.curr + '&limit=' + obj.limit;--}}
                {{--}--}}
                {{--first = false;--}}
            {{--}--}}
        {{--});--}}

        {{--function jump(data, page = 1) {--}}
            {{--let url = "/orders?{{ $status !== null ? 'status='.$status : '' }}&limit={{$limit}}&page=" + page;--}}
            {{--for (let key in data.field) {--}}
                {{--let value = data.field[key];--}}
                {{--if (value) {--}}
                    {{--url += `&${key}=${value}`;--}}
                {{--}--}}
            {{--}--}}
            {{--location.href = url;--}}
        {{--}--}}

        {{--form.on('submit(search)', function (data) {--}}
            {{--console.log(data);--}}
            {{--search = data;--}}
            {{--jump(data);--}}
        {{--});--}}

        $(".order-operation .order-operation-btn.order-check-opt-btn").click(function () {
            let url = $(this).data('url');
            console.log(url, '-------------------');
            let p = layer.open({
                title: '确认验收',
                content: '您确认验收这笔订单吗？确认后你的订单确认码会发送给师傅！'
                , btn: ['确认', '取消']
                , yes: function (index, layero) {
                    $.ajax(`${url}{{'?token='.$token}}`, {
                        method: 'PUT',
                        success(data) {
                            if (data['code'] === 'SUCCESS')
                                location.reload();
                            else
                                layer.open({
                                    title: '错误',
                                    content: data['message'],
                                    yes(){
                                        location.reload();
                                    },
                                    cancel(){
                                        location.reload();
                                    }
                                });
                            layer.close(p);
                        }
                    })
                }
                , btn2: function (index, layero) {
                    layer.close(p);
                    return false;
                }
                , cancel: function () {
                    //右上角关闭回调

                    //return false 开启该代码可禁止点击该按钮关闭
                }
            });
        });

        $(".order-operation .order-operation-btn.refund-need-opt-btn").click(function () {
            let url = $(this).data('url');
            console.log(url, '-------------------');
            let p = layer.open({
                content: '您确认需要中介介入吗'
                , btn: ['确认', '取消']
                , yes: function (index, layero) {
                    $.ajax(`${url}{{'?token='.$token}}`, {
                        method: 'PUT',
                        success(data) {
                            if (data['code'] === 'SUCCESS')
                                location.reload();
                            else
                                layer.open({
                                    title: '错误',
                                    content: data['message'],
                                    yes(){
                                        location.reload();
                                    },
                                    cancel(){
                                        location.reload();
                                    }
                                });
                            layer.close(p);
                        }
                    })
                }
                , btn2: function (index, layero) {
                    layer.close(p);
                    return false;
                }
                , cancel: function () {
                    //右上角关闭回调

                    //return false 开启该代码可禁止点击该按钮关闭
                }
            });
        });

        $(".order-operation .order-operation-btn.order-addition-opt-btn").click(function () {
            let url = $(this).data('url');
            let p = layer.open({
                // type: 1,
                title: '追加金额',
                content: "<form class=\"layui-form\" action=\"\">\n" +
                "  <div class=\"layui-form-item\">\n" +
                "    <label class=\"layui-form-label\">追加金额</label>\n" +
                "    <div class=\"layui-input-inline\">\n" +
                "      <input  type=\"number\" name=\"fee\" required  lay-verify=\"required\" placeholder=\"请输入金额\" autocomplete=\"off\" class=\"layui-input addition-fee\">\n" +
                "    </div>\n" +
                "  </div>\n" +
                " </form>"
                , btn: ['确认', '取消']
                , yes: function (index, layero) {
                    let data = {};
                    data['amount'] = $("input.addition-fee").val();
                    $.ajax(`${url}{{'?token='.$token}}`, {
                        method: 'POST',
                        data: data,
                        success(data) {
                            payLayer(layer, form, data['payment_order_id']);
                        }
                    })
                }
                , btn2: function (index, layero) {
                    layer.close(p);
                    return false;
                }
                , cancel: function () {
                    //右上角关闭回调

                    //return false 开启该代码可禁止点击该按钮关闭
                }
            });
        });

        $(".order-operation .order-operation-btn.order-apply-refund-opt-btn").click(function () {
            let url = $(this).data('url');
            let totalFee = $(this).data('total-fee');
            let p = layer.open({
                // type: 1,
                title: '申请退款',
                content: "<form class=\"layui-form refund-apply-form\" action=\"\">\n" +
                "  <div class=\"layui-form-item\">\n" +
                "    <label class=\"layui-form-label\">退款金额</label>\n" +
                "    <div class=\"layui-input-inline\">\n" +
                `      <input type=\"number\" max = "${totalFee}" name=\"refund_fee\" required  lay-verify=\"required\" placeholder=\"请输入退款金额\" autocomplete=\"off\" class=\"layui-input refund-fee\">\n` +
                "    </div>\n" +
                "  </div>\n" +
                "  <div class=\"layui-form-item\">\n" +
                "    <label class=\"layui-form-label\">备注</label>\n" +
                "    <div class=\"layui-input-inline\">\n" +
                "      <textarea  type=\"text\" name=\"remark\" required  lay-verify=\"required\" placeholder=\"请输入备注内容\" autocomplete=\"off\" class=\"layui-input remark\"></textarea>\n" +
                "    </div>\n" +
                "  </div>\n" +
                " </form>"
                , btn: ['确认', '取消']
                , yes: function (index, layero) {
                    // 'order_id', 'amount', 'remark', 'refund_mode', 'refund_method']
                    let amount = $('.refund-apply-form input').val();
                    let refundMode = amount < totalFee ? "{{\App\Models\RefundOrder::REFUND_MODE_PARTIAL}}" : "{{\App\Models\RefundOrder::REFUND_MODE_ALL}}";
                    $.ajax(`${url}&token={{$token}}`, {
                        method: 'POST',
                        data: {
                            amount: $('.refund-apply-form input.refund-fee').val(),
                            remark: $('.refund-apply-form textarea.remark').val(),
                            refund_mode: refundMode,
                            refund_method: "{{\App\Models\RefundOrder::REFUND_METHOD_BALANCE}}"
                        },
                        success(data) {

                        }
                    })
                }
                , btn2: function (index, layero) {
                    layer.close(p);
                    return false;
                }
                , cancel: function () {
                    //右上角关闭回调

                    //return false 开启该代码可禁止点击该按钮关闭
                }
            });
        });


        $(".order-operation .order-cancel-opt-btn").click(function () {
            let url = $(this).data('url');
            let p = layer.open({
                title: '确认验收',
                content: '您确认验收这笔订单吗？确认后你的订单确认码会发送给师傅！'
                , btn: ['确认', '取消']
                , yes: function (index, layero) {
                    $.ajax(`${url}{{'?token='.$token}}`, {
                        method: 'PUT',
                        success(data) {

                        }
                    })
                }
                , btn2: function (index, layero) {
                    layer.close(p);
                    return false;
                }
                , cancel: function () {
                    //右上角关闭回调

                    //return false 开启该代码可禁止点击该按钮关闭
                }
            });
        });
    });
</script>
