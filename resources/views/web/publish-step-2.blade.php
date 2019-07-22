<style>
    .order-type .q-form-item {
        text-align: -webkit-center;
        padding-top: 32px;
    }
    .step-2 .q-form-item {
        padding-top: 32px;
    }
    .step-2 .q-form-item .layui-btn.active{
        background-color: #FE8F00;
        color: #ffffff;
    }
</style>
<div class="step step-2 step-form other-info hidden">
    <div class="order-type">
        <div class="q-form-group">
            <div class="q-form-item flex">
                <div class="layui-btn layui-btn-primary active" data-order-type="0">普通订单</div>
                <div class="layui-btn layui-btn-primary" data-order-type="1">指定师傅</div>
            </div>
        </div>
    </div>
    <div class="order-master hidden">
        <div class="q-form-group">
            <div class="q-form-item flex">
                <div class="q-form-item-left q-form-label">
                    <span class="required-icon">*</span>
                    <span>选择师傅：</span>
                </div>
                <div class="q-form-item-right">
                    <select class="layui-select"></select>
                </div>
            </div>
        </div>
    </div>
    <div class="order-customer">
        <div class="q-form-group">
            <div class="q-form-item flex">
                <div class="q-form-item-left q-form-label">
                    <span class="required-icon">*</span>
                    <span>客户姓名：</span>
                </div>
                <div class="q-form-item-right">
                   <input class="layui-input customer-name" placeholder="请输入客户姓名">
                </div>
            </div>
            <div class="q-form-item flex">
                <div class="q-form-item-left q-form-label">
                    <span class="required-icon">*</span>
                    <span>客户号码：</span>
                </div>
                <div class="q-form-item-right">
                    <input class="layui-input customer-mobile" placeholder="请输入客户号码">
                </div>
            </div>
            <div class="q-form-item flex">
                <div class="q-form-item-left q-form-label">
                    <span class="required-icon">*</span>
                    <span>客户地址：</span>
                </div>
                <div class="q-form-item-right">
                    <input class="layui-input customer-address" placeholder="请输入客户地址">
                </div>
            </div>
            <div class="q-form-item flex">
                <div class="q-form-item-left q-form-label">
                    <span class="required-icon">*</span>
                    <span>第三方订单号：</span>
                </div>
                <div class="q-form-item-right">
                    <input class="layui-input customer-order-no" placeholder="请输入第三方订单号">
                </div>
            </div>
        </div>
    </div>
    <div class="order-shipping">
        <div class="q-form-group">
            <div class="q-form-item flex">
                <div class="q-form-item-left q-form-label">
                    <span class="required-icon">*</span>
                    <span>物流公司：</span>
                </div>
                <div class="q-form-item-right">
                    <input class="layui-input shopping-company" placeholder="请输入物流公司">
                </div>
            </div>
            <div class="q-form-item flex">
                <div class="q-form-item-left q-form-label">
                    <span class="required-icon">*</span>
                    <span>物流单号：</span>
                </div>
                <div class="q-form-item-right">
                    <input class="layui-input shipping-order-no" placeholder="请输入物流单号">
                </div>
            </div>
            <div class="q-form-item flex">
                <div class="q-form-item-left q-form-label">
                    <span class="required-icon">*</span>
                    <span>提货地址：</span>
                </div>
                <div class="q-form-item-right">
                    <input class="layui-input shipping-address" placeholder="请输入提货地址">
                </div>
            </div>
            <div class="q-form-item flex">
                <div class="q-form-item-left q-form-label">
                    <span class="required-icon">*</span>
                    <span>提货电话：</span>
                </div>
                <div class="q-form-item-right">
                    <input class="layui-input shipping-phone-no" placeholder="请输入提货电话">
                </div>
            </div>
            <div class="q-form-item flex">
                <div class="q-form-item-left q-form-label">
                    <span class="required-icon">*</span>
                    <span>包装件数：</span>
                </div>
                <div class="q-form-item-right">
                    <input class="layui-input pack-number" placeholder="请输入包装件数">
                </div>
            </div>
        </div>
    </div>
    <div class="order-other">
        <div class="q-form-group">
            <div class="q-form-item flex">
                <div class="q-form-item-left q-form-label">
                    <span class="required-icon">*</span>
                    <span>服务时间：</span>
                </div>
                <div class="q-form-item-right">
                    <select class="layui-select"></select>
                </div>
            </div>
            <div class="q-form-item flex">
                <div class="q-form-item-left q-form-label">
                    <span class="required-icon">*</span>
                    <span>备注：</span>
                </div>
                <div class="q-form-item-right">
                    <textarea  type="text" class="layui-textarea" style="with:416px !important;"></textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="order-concat">
        <div class="q-form-group">
            <div class="q-form-item flex">
                <div class="q-form-item-left q-form-label">
                    <span class="required-icon">*</span>
                    <span>真实姓名：</span>
                </div>
                <div class="q-form-item-right">
                    <input class="layui-input customer-real-name" placeholder="请输入真实姓名">
                </div>
            </div>
            <div class="q-form-item flex">
                <div class="q-form-item-left q-form-label">
                    <span class="required-icon">*</span>
                    <span>联系电话：</span>
                </div>
                <div class="q-form-item-right">
                    <input class="layui-input contact-phone-number" placeholder="请输入联系电话">
                </div>
            </div>
        </div>
    </div>
    <div class="next-opt">
        <p>还差一步，继续完善订单详细信息，就能成功发单了！</p>
        <div class="layui-btn layui-btn-primary next-btn">下一步</div>
    </div>
</div>
<script>
$(function () {
    $(document).on('click', '.order-type .layui-btn', function () {
        $('.order-type .layui-btn').removeClass('active');
        $(this).addClass('active');
        let type = $(this).data('order-type');
        if(type) {
            $('.order-master').removeClass('hidden');
        }else{
            $('.order-master').addClass('hidden');
        }
    });
});
</script>
