function imgChange(obj, num) {
    //获取点击的文本框
    var file = document.getElementById("file");
    //获取的图片文件
    var fileList = file.files;
    //文本框的父级元素
    // var input = document.getElementsByClassName(obj2)[0];
    var imgArr = [];

    //遍历获取到得图片文件
    for (var i = 0; i < fileList.length; i++) {
        var imgUrl = window.URL.createObjectURL(file.files[i]);
        imgArr.push(imgUrl);
        var div = $("<div class='z_addImg'><img src =" + imgUrl + "><div class='del-img'></div><div class='mask'></div></div>")
        if ($(".z_addImg").length > 4) {
            $(".upload_file").addClass("hide")
            return
        } else {
            $(".upload_file").removeClass("hide")
            $(".upload_file").before(div)
        }

    }
    ;
    imgRemove();
};

function imgRemove() {
    $(".del-img").click(function () {
        $(this).parent().remove()
        $(".upload_file").removeClass("hide")
    })


};
