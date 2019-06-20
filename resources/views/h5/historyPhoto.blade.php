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
<div class="top-header">
    <h2>商品选择</h2>
    <span class="back-icon"></span>
    <span class="select-photo">筛选</span>
    <div class="item-options hide">
        <ul>
            <li class="select-active">柜类</li>
            <li>床类</li>
            <li>沙发类</li>
            <li>桌类</li>
        </ul>
    </div>
    <div class="select-mask"></div>
</div>
<div class="wrap bg-color">

    <div class="select-mask"></div>
    <div class="photo-wrap cell-item">
        <div class="img-item">
            <img src="/h5/img/product.jpg">
            <span>两门小衣柜</span>
            <input type="checkbox" name="checkbox"/>
        </div>
        <div class="img-item">
            <img src="/h5/img/product.jpg">
            <span>两门小衣柜</span>
            <input type="checkbox" name="checkbox"/>
        </div>
        <div class="img-item">
            <img src="/h5/img/product.jpg">
            <span>两门小衣柜</span>
            <input type="checkbox" name="checkbox"/>
        </div>
        <div class="img-item">
            <img src="/h5/img/product.jpg">
            <span>两门小衣柜</span>
            <input type="checkbox" name="checkbox"/>
        </div>
        <div class="img-item">
            <img src="/h5/img/product.jpg">
            <span>两门小衣柜</span>
            <input type="checkbox" name="checkbox"/>
        </div>
    </div>
</div>
<div class="cell-item bottom-box">
    <div class="flex1">返回</div>
    <div class="flex1 active-btn">确定</div>
</div>
</body>
<script>
    $('.select-photo').click(function () {
        if ($(".item-options").hasClass("hide")) {
            $(".item-options").removeClass("hide")
            $(".select-mask").show()
        } else {
            $(".item-options").addClass("hide")
            $(".select-mask").hide()
        }
        $(".item-options li").click(function () {
            var item = $(this).index()
            var texts = $(".item-options li:eq(" + item + ")").html()
            $(".item-options li:eq(" + item + ")").addClass("select-active").siblings().removeClass("select-active")
            $(".select-mask").hide()
            $(".item-options").addClass("hide")
        })

    })
</script>

</html>
