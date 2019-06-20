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

</head>

<body>
<div class="wrap">

    <div class="top">
        <div class="info">
            <div class="header-portrait">
                <img src="/h5/img/portrait.png">
            </div>
            <div class="name">张三</div>
            <div class="wallet-balance">
                <span class="number">￥23453.82</span>
                <span>钱包余额</span>
            </div>
            <div>
                <button class="btn">充值</button>
            </div>
        </div>
    </div>

    <!--content-->
    <div class="my-order clearfix">
        <a href="/orders">
            <div>
                <img src="/h5/img/order_icon_1.png">
            </div>
            <p>待雇佣</p>
            <div class="point-view">1</div>
        </a>
        <a href="">
            <div>
                <img src="/h5/img/order_icon_2.png">
            </div>
            <p>待托管</p>
        </a>
        <a href="/orders">
            <div>
                <img src="/h5/img/order_icon_3.png">
            </div>
            <p>服务中</p>
        </a>
        <a href="/orders">
            <div>
                <img src="/h5/img/order_icon_4.png">
            </div>
            <p>待确认</p>
        </a>
        <a href="/orders">
            <div>
                <img src="/h5/img/order_icon_5.png">
            </div>
            <p>待验收</p>
        </a>
    </div>


    <!--footer-->
    @include('h5.navbar')
</div>
</body>
<script>
    var swiper = new Swiper('.swiper-banner', {
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        }
    });
</script>

</html>
