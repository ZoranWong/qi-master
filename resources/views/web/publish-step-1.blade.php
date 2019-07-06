<style>
    .step-header {
        background-color: #fbb55b;
        padding: 12px;
        display: flex;
    }

    .step-header div {
        color: #fff;
        font-size: 16px;
    }

    .step-header i {
        font-size: 16px;
    }

    .q-form-group {
        margin-top: 18px;
    }

    .required-icon {
        color: #a83800;
    }

    .q-form-item-left {
        width: 15%;
        text-align: right;
        max-width: 180px;
        min-width: 124px;
        margin-top: 10px;
    }

    .q-form-right {
        width: 85%;
    }

    .q-form-label span {
        vert-align: middle;
        line-height: 100%;
        display: inline;
        height: 100%;
    }

    .q-form-item {
        background-color: #ffffff;
        border-bottom-left-radius: 4px;
        border-bottom-right-radius: 4px;
        padding-bottom: 32px;
        /*margin-bottom: 12px;*/
    }

    .hidden {
        display: none;
    }

    .classification-icon {
        width: 32px;
        height: 32px;
    }

    .classifications-radio-box {
        align-items: left;
    }

    .classification {
        padding: 12px;
        margin: 12px;
        border-radius: 6px;
        border: #c5c5c5 1px solid;
        width: 64px;
        height: 64px;
    }

    .classifications-selector .classification:hover {
        cursor: pointer;
    }

    .classification p.icon {
        margin-bottom: 12px;
        text-align: center;
    }

    .classification .classification-name {
        text-align: center;
    }

    .classifications-selector .q-form-item-left {
        margin-top: 42px;
    }

    .classifications-selected .q-form-item-left {
        margin-top: 46px;
    }

    .classifications-selected .change-classification {
        margin-top: 82px;
        margin-left: 12px;
    }

    .classifications-selected .change-classification:hover {
        cursor: pointer;
    }

    .classification-selected, .service-type-selected {
        border: #fe8f00 1px solid;
        position: relative;
        color: #fe8f00;
    }

    .selected-icon {
        color: #ffffff;
        position: absolute;
        right: 0;
        text-align: right;
        bottom: 0;
        width: 0;
        height: 0;
        border-style: solid;
        border-width: 0 0 28px 28px;
        border-color: transparent transparent #fe8f00 transparent;
        /*border-bottom-right-radius: 4px;*/
    }
    .selected-icon i.icon{
        position: absolute;
        right: 0;
        bottom: -28px;
    }
    .service-type-btn {
        margin-left: 6px;
        margin-right: 6px;
    }
    .service-type-btn .selected-icon {
        border-width: 0 0 24px 24px;
    }
    .service-type-btn .selected-icon i.icon{
        right: -4px;
        bottom: -36px;
        font-size: 14px;
    }
    .form-item-module{
        margin-top: 18px;
        padding-top: 32px;
        border-radius: 4px;
    }

    .q-form-btn:hover {
        border: #fe8f00 1px solid;
        color: #fe8f00;
    }
</style>
<div class="step">
    <div class="step-header">
        <div class="icon">
            <i class="layui-icon layui-icon-auz"></i>
        </div>
        <div>
            平台提供线上担保交易，保障您的资金安全，且不会收取您任何佣金。80%的带货跑路、漫天加价均由线下交易导致，请勿线下交易。
        </div>
    </div>
</div>
<div class="step step-1 select-classification hidden">
    <div class="q-form-group classifications-container">
        <div class="q-form-item flex classifications-selector">
            <div class="q-form-item-left q-form-label">
                <span class="required-icon">*</span>
                <span>选择服务类目：</span>
            </div>
            <div class="q-form-right">
                <ul class="classifications-radio-box flex">
                    @foreach($classifications as $classification)
                        <li class="radio-box classification-radio-box flex">
                            <div class="classification" data-id="{{$classification->id}}">
                                <p class="icon">
                                    <input class="radio-input" type="radio">
                                    <image class="classification-icon" src="{{$classification->iconUrl}}"></image>
                                </p>
                                <p class="classification-name"><span>{{$classification->name}}</span></p>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="step step-1 select-product">
    <div class="q-form-item flex classifications-selected">
        <div class="q-form-item-left q-form-label">
            <span class="required-icon">*</span>
            <span>服务类目：</span>
        </div>
        <div class="q-form-right flex">
            <div class="classification-selected classification">
                <p class="icon">
                    <input class="radio-input" type="radio">
                    <image class="classification-icon" src="{{$classifications[0]->iconUrl}}"></image>
                </p>

                <p class="classification-name"><span>{{$classifications[0]->name}}</span></p>
                <div class="selected-icon">
                    <i class="icon layui-icon layui-icon-ok"></i>
                </div>
            </div>
            <div class="change-classification">修改类目</div>
        </div>
    </div>
    <div class="q-form-item flex service-types-selector">
        <div class="q-form-item-left q-form-label">
            <span class="required-icon">*</span>
            <span>服务类型：</span>
        </div>
        <div class="q-form-right flex">
            <ul class="service-type-list flex">

            </ul>
        </div>
    </div>
    <div class="q-form-item form-item-module flex products-container hidden">
        <div class="q-form-item-left q-form-label">
            <span class="required-icon">*</span>
            <span>商品信息：</span>
        </div>
        <div class="q-form-right flex">
            <ul class="product-list flex">
                <div class="layui-btn layui-btn-primary q-form-btn"  data-toggle="modal" data-target="#productSelector">
                    <i class="layui-icon layui-icon-add-1"></i>
                    添加商品图片
                </div>
            </ul>
        </div>
    </div>
</div>
@include('web.user-products')
<script>
    const classifications = {!! $classifications !!};
    $(function () {

        $('.change-classification').click(function () {
            $('.select-classification').removeClass('hidden');
            $('.select-product').addClass('hidden');
            $('.products-container').addClass('hidden');
        });
        if(classifications.length > 0 && classifications[0]['service_types'].length > 0)
            serviceTypesListRender(classifications[0]['service_types']);
        $('.classifications-selector .classification').click(function () {
            $('.select-classification').addClass('hidden');
            $('.select-product').removeClass('hidden');
            let id = $(this).data('id');
            let classification = _.find(classifications, {id: id});
            $('.classifications-selected .classification-selected .classification-icon').attr('src', classification['icon_url']);
            $('.classifications-selected .classification-selected .classification-name span').html(classification['name']);
            serviceTypesListRender(classification['service_types']);
        });

        function serviceTypesListRender(serviceTypes) {
            let count = serviceTypes.length;
            let listHtml = '';
            for (let i = 0; i < count; i++) {
                let serviceType = serviceTypes[i];

                let item = `<li class="service-type">
                    <div class="layui-btn layui-btn-primary service-type-btn q-form-btn">${serviceType['name']}</div>
                </li>`;
                listHtml += item;
            }

            $('.service-type-list').html(listHtml);
        }

        $(document).on('click', '.service-type-btn', function () {
            $('.service-type .service-type-btn').removeClass('service-type-selected');
            $(this).addClass('service-type-selected');
            $('.service-type-btn .selected-icon').remove();
            $(this).append(`
            <div class="selected-icon">
                    <i class="icon layui-icon layui-icon-ok"></i>
                </div>
            `);
            $('.products-container').removeClass('hidden');
        });

        $('document').on('mouseenter', '.service-type-btn', function () {

        });
    });
</script>
