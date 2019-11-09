<script>
    function urlReplace(url, id) {
        url = decodeURIComponent(url);
        let tmp = url.split('$');
        url = tmp[0] + id + tmp[2];
        return url;
    }
    function payLayer(layer, form, id = 1) {
        layer.open({
            title: '选择支付方式',
            content: "<div class=\"order-pay-type \" >\n" +
            "        <form class=\"layui-form\">\n" +
            "            <div class=\"layui-form-item\">\n" +
            "                <ul>\n" +
            "                    <li><input type=\"radio\" name=\"pay_type\" value=\"WechatPay\" title=\"微信支付\" checked></li>\n" +
            "                    <li><input type=\"radio\" name=\"pay_type\" value=\"AliPay\" title=\"支付宝支付\"></li>\n" +
            "                    <li><input type=\"radio\" name=\"pay_type\" value=\"BalancePay\" title=\"余额支付\"></li>\n" +
            "                </ul>\n" +
            "            </div>\n" +
            "        </form>\n" +
            "    </div>",
            success(data) {
                form.render();
            },
            yes(data) {
                let payType = $('.order-pay-type input:radio:checked[name="pay_type"]').val();
                let host = location.origin;
                let url = "";
                switch (payType) {
                    case 'WechatPay':
                        // url = `${host}/wx/pay/${id}`;
                        url = "{{route('user.wx.pay', ['order' => '$id$'])}}";
                        url = urlReplace(url, id);
                        layer.closeAll();
                        window.open(url)
                        break;
                    case 'AliPay':
                        // url = `${host}/ali/pay/${id}`;
                        url = "{{route('user.wx.pay', ['order' => '$id$'])}}";
                        url = urlReplace(url, id);
                        layer.closeAll();
                        window.open(url)
                        break;
                    case 'BalancePay':
                        url = "{{route('user.balance.pay', ['order' => '$id$'])}}";
                        url = urlReplace(url, id);
                        url = url + "{{$token}}";
                        $.get(url);
                        break;
                }
            }
        });

    }
</script>
