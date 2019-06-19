<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title></title>
    <meta content="yes" name="apple-mobile-web-app-capable"/>
    <meta content="black" name="apple-mobile-web-app-status-bar-style"/>
    <meta name="viewport"
          content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no"/>
    <link rel="stylesheet" href="/h5/plugin/weui/css/weui.min.css">
    <link rel="stylesheet" href="/h5/css/base.css"/>
    <link rel="stylesheet" href="/h5/css/index.css"/>
    <script type="text/javascript" src="/h5/js/rem.js"></script>
    <script type="text/javascript" src="/h5/js/jquery-3.3.1.js"></script>
    <script src="/h5/plugin/citypicker/js/Popt.js"></script>
    <script src="/h5/plugin/citypicker/js/cityJson.js"></script>
    <script src="/h5/plugin/citypicker/js/citySet.js"></script>
    <script src="/h5/plugin/weui/js/jquery-weui.min.js"></script>


</head>

<body>
<div class="top-header">
    <h2>发布订单</h2>
    <span class="back-icon"></span>
</div>
<div class="wrap">


    <!--客户信息-->
    <div class="install-section pa-t">
        <div class="cate-tit cell-item">
            <div class="short-line"></div>
            客户信息
        </div>
        <div class="install-item cell-item">
            <div class="label-text">
                <span class="required-icon">*</span>
                <span>客户姓名</span>
            </div>
            <div class="input-field">
                <input type="text" placeholder="请输入客户姓名">
            </div>
        </div>
        <div class="install-item cell-item">
            <div class="label-text">
                <span class="required-icon">*</span>
                <span>手机号码</span>
            </div>
            <div class="input-field">
                <input type="text" placeholder="请输入手机号码">
            </div>
        </div>
        <div class="install-item cell-item">
            <div class="label-text">
                <span class="required-icon">*</span>
                <span>所在地区</span>
            </div>
            <div class="input-field next-arrow">
                <input type="text" name="city" placeholder="请选择" id="city" readonly="" class="cityselect">
            </div>
        </div>
        <div class="install-item cell-item">
            <div class="label-text">
                <span class="required-icon">*</span>
                <span>详细地址</span>
            </div>
            <div class="input-field">
                <textarea placeholder="请输入客户详情地址，精确到街道、门牌号" maxlength="100" class="address-text"></textarea>
            </div>
        </div>
    </div>

    <!--其他要求-->
    <div class="install-section mr-t">
        <div class="cate-tit cell-item">
            <div class="short-line"></div>
            其他信息
        </div>
        <div class="install-item cell-item">
            <div class="label-text">
                <span class="required-icon">*</span>
                <span>期望时间</span>
            </div>
            <div class="input-field">
                <input type="text" data-toggle='date' placeholder="期望时间" id="my-input"/>
            </div>
        </div>
        <div class="install-item cell-item">
            <div class="label-text">
                <span class="required-icon">*</span>
                <span>备注</span>
            </div>
            <div class="input-field">
                <textarea placeholder="请填写客户和物流的备注，以及其他需要师傅注意的内容，所填写信息必须和订单必填项内容保持一致。" maxlength="200"></textarea>
            </div>
        </div>
        <div class="install-item">
            <div class="remark-tip">
                <span class="special-tip">温馨提示</span>：请勿在备注信息中填写与订单必填产品信息不符的内容，如：除了订单产品还要安装***、需要师傅帮忙维修***等等额外服务信息，以免因为师傅忽略而导致交易纠纷，一旦因此发生纠纷，平台仲裁将以订单必填信息为准。
            </div>
        </div>
    </div>

    <!--联系人信息-->
    <div class="install-section mr-t">
        <div class="cate-tit cell-item">
            <div class="short-line"></div>
            联系人信息
        </div>
        <div class="install-item cell-item">
            <div class="label-text">
                <span class="required-icon">*</span>
                <span>真实姓名</span>
            </div>
            <div class="input-field">
                <input type="text" placeholder="张三">
            </div>
        </div>
        <div class="install-item cell-item">
            <div class="label-text">
                <span class="required-icon">*</span>
                <span>联系电话</span>
            </div>
            <div class="input-field">
                <input type="tel" placeholder="15247856325" maxlength="11">
            </div>
        </div>
    </div>

</div>

<div class="next-p">
    <a href="ordersuccess.html" class="go-n">提交订单</a>
</div>
</body>
<script>
    $("#city").click(function (e) {
        SelCity(this, e);
        console.log(this);
    });
    $("#my-input").calendar();
</script>

</html>
