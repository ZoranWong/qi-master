<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title></title>
    <meta content="yes" name="apple-mobile-web-app-capable"/>
    <meta content="black" name="apple-mobile-web-app-status-bar-style"/>
    <meta name="viewport"
          content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no"/>
    <link rel="stylesheet" href="/h5/plugin/mobileselect/css/mobileSelect.css">
    <link rel="stylesheet" href="/h5/css/base.css"/>
    <link rel="stylesheet" href="/h5/css/index.css"/>
    <script type="text/javascript" src="/h5/js/rem.js"></script>
    <script type="text/javascript" src="/h5/js/jquery-3.3.1.js"></script>
    <script type="text/javascript" src="/h5/plugin/mobileselect/js/mobileSelect.js"></script>
</head>

<body>
<div class="top-header">
    <h2>发布订单</h2>
    <span class="back-icon"></span>
</div>
<div class="wrap">
    <div class="install-section pa-t">
        <div class="install-item cell-item select-img align">
            <div class="label-text">
                <span class="required-icon">*</span>
                <span>商品图片</span>
            </div>
            <div class="flex1 normal-color upload-img next-arrow">
                <img src="/h5/img/add.png" id="good-img">
            </div>
        </div>
        <div class="install-item cell-item">
            <div class="label-text">
                <span class="required-icon">*</span>
                <span>商品类别</span>
            </div>
            <div id="select-cate" class="flex1 normal-color next-arrow">请选择商品类别</div>
        </div>
        <div class="install-item cell-item">
            <div class="label-text">
                <span class="required-icon">*</span>
                <span>商品型号</span>
            </div>
            <div class="input-field">
                <input type="text" placeholder="请填写商品型号">
            </div>
        </div>
        <div class="install-item cell-item align">
            <div class="label-text">
                <span class="required-icon">*</span>
                <span>商品数量</span>
            </div>
            <div class="cell-item mr10">
                <div class="count minus">-</div>
                <input type="number" placeholder="数量" class="number-input" value="1">
                <div class="count add">+</div>
            </div>
            <div>张</div>
        </div>
        <div class="install-item cell-item">
            <div class="label-text special-require">
                <span>特殊要求</span>
            </div>
            <div class="input-field">
                <textarea placeholder="请填写尺寸、体积、重量等特殊要求有利于师傅更准确的报价" maxlength="100"></textarea>
            </div>

        </div>

    </div>
</div>

<div class="next-p">
    <a href="/publish/custominfo" class="go-n">下一步</a>
</div>

<!--选择商品图片-->
<div class="pop-dialog hide">
    <div class="pop-mask"></div>
    <div class="dialog-content">
        <div class="title">选择商品图片</div>
        <div class="cell-item select-item">
            <div>
                <img src="/h5/img/upload.png">
                <span>上传商品图片</span>
                <input type="file" accept="image/*" id="img-change" multiple="multiple">
            </div>
            <div>
                <a href="/publish/historyPhoto">
                    <img src="/h5/img/local.png">
                    <span>从商品库中选择</span>
                </a>
            </div>
        </div>
        <div class="close-icon"></div>
    </div>
</div>
</body>
<script type="text/javascript">
    //数量加减
    $(function () {
        $(".add").click(function () {
            let num = $('.number-input').val()
            num++
            $(".number-input").val(num)
        })
        $(".minus").click(function () {
            let num = $('.number-input').val()
            num--
            if (num <= 0) return num
            $(".number-input").val(num)
        })

    })

    //商品图片的选择

    $(".select-img").click(function () {
        $(".pop-dialog").removeClass('hide')
        $(".pop-mask").click(function () {
            $(".pop-dialog").addClass('hide')
        })
        $(".close-icon").click(function () {
            $(".pop-dialog").addClass('hide')

        })
    })

    $(function () {
        $("#img-change").change(function () {
            var $file = $(this);
            var fileObj = $file[0];
            var windowURL = window.URL || window.webkitURL;
            var dataURL;
            var $img = $("#good-img");
            if (fileObj && fileObj.files && fileObj.files[0]) {
                dataURL = windowURL.createObjectURL(fileObj.files[0]);
                console.log(dataURL)
                $img.attr('src', dataURL);
                $(".pop-dialog").addClass('hide')
            } else {
                dataURL = $file.val();
                var imgObj = document.getElementById("good-img");
                imgObj.style.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale)";
                imgObj.filters.item("DXImageTransform.Microsoft.AlphaImageLoader").src = dataURL;
            }
        });
    })


    //商品类型选择
    var mobileSelect3 = new MobileSelect({
        trigger: '#select-cate',
        title: '',
        wheels: [{
            data: [{
                id: '1',
                value: '柜类',
                childs: [{
                    id: '1',
                    value: '床头柜'
                },
                    {
                        id: '2',
                        value: '电视柜'
                    },
                    {
                        id: '3',
                        value: '床边柜'
                    },
                    {
                        id: '4',
                        value: '鞋柜'
                    },
                    {
                        id: '5',
                        value: '储物柜'
                    }
                ]
            },
                {
                    id: '2',
                    value: '床类',
                    childs: [{
                        id: '1',
                        value: '布艺床'
                    },
                        {
                            id: '2',
                            value: '实木床'
                        },
                        {
                            id: '3',
                            value: '板式床'
                        }
                    ]
                },
                {
                    id: '3',
                    value: '沙发类'
                },
                {
                    id: '4',
                    value: '桌类'
                }
            ]
        }],
        position: [0, 1],
        callback: function (indexArr, data) {
            document.getElementById('select-cate').style.color = '#333'
            console.log(data); //Returns the selected json data
        }
    });
</script>

</html>
