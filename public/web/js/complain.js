/* 投诉详情js--------------------------------------------------------------------*/
$(function () {
    previewImage.init();

    $("#revocation_btn").on("click", function () {
        $(".cover,#relieveBindPane").show();
    });

    $("#relieveBindPane .close,#relieveBindPane .cancel").on("click", function () {
        $(".cover,#relieveBindPane").hide();
    });

    // 图片预览
    $(".swiper-container .preview_close").on("click", function () {
        $(".cover,.preview_con").hide();
    });

});   

    	
	
	

    
    
    
    
    
    
    
