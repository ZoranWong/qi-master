/**
 * 图片预览功能
 * author liheng
 * 2017-09-01
 */
previewImage = {
    swiper: null,
    init: function () {
        // 图片预览容器
        var dom = '<div class="preview_con" style="display: none">'
        dom += '<div class="swiper-container">'
        dom += '<div class="preview_close" title="关闭"></div>'
        dom += '<div class="swiper-wrapper"  id="swiper-preview-img">'
        dom += '</div>'
        dom += '<div class="swiper-pagination"></div>'
        dom += '<div class="swiper-button-next"></div>'
        dom += '<div class="swiper-button-prev"></div>'
        dom += '</div>'
        dom += '</div>'
        $("body").append(dom);
        // 获取需要预览的图片组合
        $("body").on("click", "img[data-preview-group]", function () {
            var group = $(this).attr("data-preview-group");
            console.log(group)
            var previewList = $("img[data-preview-group=" + group + "]");
            var t_index = $(previewList).index($(this));
            previewImage.preview(previewList, t_index);
        });
        // 图片预览
        $(".swiper-container .preview_close").on("click", function () {
            $(".cover,.preview_con").fadeOut();
        });
    }, preview: function (imgList, index) {
        $("#swiper-preview-img").children('.swiper-slide').remove();
        if (imgList.length == 1) {
            $("#swiper-preview-img").siblings(".swiper-pagination,.swiper-button-next,.swiper-button-prev").hide();
        } else {
            $("#swiper-preview-img").siblings(".swiper-pagination,.swiper-button-next,.swiper-button-prev").show();
        }
        // 插入图片列表
        var t_dom = "";
        $(imgList).each(function () {
            var t_src = $(this).attr("src");
            t_dom += '<div class="swiper-slide swiper-no-swiping">'
            t_dom += '<img onload="previewImage.drawImage(this,832,611)" src="' + t_src + '">'
            t_dom += '</div>'
        });
        $("#swiper-preview-img").append(t_dom);

        $(".cover,.preview_con").fadeIn();
        if (previewImage.swiper) {
            previewImage.swiper.destroy(true, true);
        }
        previewImage.swiper = new Swiper('.swiper-container', {
            pagination: '.swiper-pagination',
            initialSlide: index,
            paginationClickable: true,
            nextButton: '.swiper-button-next',
            prevButton: '.swiper-button-prev',
            spaceBetween: 30,
            effect: 'fade',
            loop: true,
            observer: true,//修改swiper自己或子元素时，自动初始化swiper
            observeParents: true //修改swiper的父元素时，自动初始化swiper
        });
    }, drawImage: function (ImgD, w, h) {
        var image = new Image();
        image.src = ImgD.src;
        var _currentWidth = image.width;
        var _currentHeight = image.height;
        if (image.width > 0 && image.height > 0) {
            if (_currentWidth / _currentHeight > w / h) {
                ImgD.width = w;
                ImgD.height = _currentHeight / _currentWidth * w;
            } else {
                ImgD.height = h;
                ImgD.width = _currentWidth / _currentHeight * h;
            }
        }
    }
};
