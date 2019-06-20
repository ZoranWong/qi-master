<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title></title>
    <meta content="yes" name="apple-mobile-web-app-capable"/>
    <meta content="black" name="apple-mobile-web-app-status-bar-style"/>
    <meta name="viewport"
          content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no"/>
    <link rel="stylesheet" href="/h5/css/base.css"/>
    <link rel="stylesheet" href="/h5/css/index.css"/>
    <script type="text/javascript" src="/h5/js/rem.js"></script>
    <script type="text/javascript" src="/h5/js/base.js"></script>
</head>

<body>
<div class="wrap">
    <div class="top-fix">
        <div>3个报价</div>
        <div class="order-count">
            <span>雇佣倒计时</span>
            <span id="countdown"></span>
        </div>
        <div>计时结束订单关闭</div>
    </div>

    <div>
        <ul class="query-list">
            <li>
                <div class="price">
                    <span>报价¥118</span>
                    <a href="" class="now-item-btn">雇佣</a>
                </div>
                <div class="cell-item">
                    <div class="mr10">
                        <img src="/h5/img/portrait.png" class="avatar">
                    </div>
                    <div class="query-info">
                        <span>王贺东</span>
                        <span>评分5.00&nbsp;|&nbsp;好评率99%&nbsp;| 近30天102单 | 合作0次</span>
                    </div>
                </div>
            </li>
        </ul>
    </div>

</div>
</body>
<script>
    document.oncopy = function () {
        event.returnValue = false;
    }
</script>

</html>
