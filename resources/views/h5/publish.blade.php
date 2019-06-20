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
    <script type="text/javascript" src="/h5/js/jquery-3.3.1.js"></script>
</head>

<body>
<div class="wrap">
    <div class="top-header">
        <h2>发布订单</h2>
        <span class="back-icon"></span>
    </div>
    <div class="category">
        <div class="cate-tit cell-item">
            <div class="short-line"></div>
            请选择分类
        </div>
        <div class="service-cate flex">
            <div class="cate-item">
                <i class="icon-1"></i>
                <div>家具</div>
            </div>
            <div class="cate-item">
                <i class="icon-2"></i>
                <div>灯具</div>
            </div>
            <div class="cate-item">
                <i class="icon-3"></i>
                <div>卫浴</div>
            </div>
            <div class="cate-item">
                <i class="icon-4"></i>
                <div>家电</div>
            </div>
            <div class="cate-item">
                <i class="icon-5"></i>
                <div>吊顶</div>
            </div>
        </div>
    </div>
    <div class="service-type">
        <div class="cate-tit cell-item">
            <div class="short-line"></div>
            请选择服务类型
        </div>
        <div class="service-cate flex">
            <div class="cate-item">
                <i class="icon-6"></i>
                <div>安装</div>
            </div>
            <div class="cate-item">
                <i class="icon-7"></i>
                <div>维修</div>
            </div>
            <div class="cate-item">
                <i class="icon-8"></i>
                <div>配送</div>
            </div>
            <div class="cate-item">
                <i class="icon-9"></i>
                <div>保养</div>
            </div>
            <div class="cate-item">
                <i class="icon-10"></i>
                <div>配送+安装</div>
            </div>
        </div>
    </div>
</div>
<div class="next-p">
    <a href="/publish/install" class="go-n">下一步</a>
</div>
</body>
<script>
    $(".category .cate-item").click(function () {
        $(this).addClass('active').siblings().removeClass('active')
    })
    $(".service-type .cate-item").click(function () {
        var i = $(this).index()
        console.log(i)
        $(this).addClass('active').siblings().removeClass('active')
    })
</script>

</html>
