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
        height: max-content;
    }

    .q-form-right {
        width: 85%;
        height: max-content;
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
        overflow: hidden;
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
    .img-box {
        width: 64px;
        height: 64px;
    }
    .product-item {
        width: 764px;
        border: #c5c5c5 1px solid;
        border-radius: 4px;
        margin: 12px;
    }
    .product-item .product-left {
        margin: 24px;
    }

    .product-item .product-right {
        margin: 12px;
        position: relative;
    }
    .product-item .product-item-desc {
        margin: 8px;
    }
    .product-item .product-item-desc .title {
        margin-top: 8px;
    }
    .remove-btn {
        position: absolute;
        right: 12px;
        top: 0;
        cursor: pointer;
    }
    .remove-btn i{
        font-size: 32px;
        color: #c5c5c5;
    }
    .remove-btn:hover i{
        color: #FE8F00;
    }
    .add-product {
        margin-left: 8px;
    }
    .next-opt p {
        margin-top: 12px;
        text-align: right;
        font-size: 14px;
        color: #c5c5c5;
    }
    .next-btn {
        background: #fe8f00;
        color: #ffffff;
        position: absolute;
        right: 0;
        margin-top: 8px;
        margin-bottom: 32px;
    }
    .layui-textarea {
        width: 416px !important;
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
                                    {{--<input class="radio-input" type="radio">--}}
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
                    {{--<input class="radio-input" type="radio">--}}
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
        <div class="q-form-right">
            <div class="product-list flex-column" style="display: flex !important;">

            </div>
            <div class="layui-btn layui-btn-primary q-form-btn add-product"  data-toggle="modal" data-target="#productSelector">
                <i class="layui-icon layui-icon-add-1"></i>
                添加商品图片
            </div>
        </div>
    </div>
</div>
<div class="next-opt">
    <p>还差一步，继续完善订单详细信息，就能成功发单了！</p>
    <div class="layui-btn layui-btn-primary next-btn">下一步</div>
</div>
@include('web.user-products', ['classifications' => $classifications, 'productsUrl' => $productsUrl])
<script>

    $(function () {
        layui.use(['form'], function () {
            let form = layui.form;
            let classification = classifications[0];
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
                orderInfo['classification_id'] = id;
                classification = _.find(classifications, {id: id});
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
                    <div class="layui-btn layui-btn-primary service-type-btn q-form-btn" data-id = "${serviceType['id']}" data-use-history="${serviceType['use_history_product']}">${serviceType['name']}</div>
                </li>`;
                    listHtml += item;
                }

                $('.service-type-list').html(listHtml);
            }

            function renderProductsList(products, itemRender) {
                let html = '';
                products.forEach(function (value) {
                    html += itemRender(value);
                })
                $('.products-container .product-list').html(html);
                form.render('select');
            }

            function categorySelector(selectedIndex = 0) {
                console.log('------------------', classification);
                let selectorBegin = `<select class=\"layui-select category-id\" lay-filter='categories' value='${selectedIndex}'>`;
                let options = "";
                let selectorEnd = "</select>";

                for (let i = 0; i < classification['categories'].length; i ++) {
                    options += `<option ${i == selectedIndex ? 'selected' : ''} value="${i}">${classification['categories'][i]['name']}</option>`;
                }
                let children = classification['categories'][0]['children'];
                return selectorBegin + options + selectorEnd + childCategorySelector(children);
            }

            form.on('select(categories)', function(data){
                let index = data['value'];
                console.log('------------ category ---------', index, data)
                let selector = categorySelector(index);
                let productItem = $(data['elem']).closest('.product-item');
                $($(productItem).find('.selector.product-categories')).html(selector);
                let propertyArray = classification['categories'][index]['properties'];
                console.log("--------------", propertyArray, $(productItem).find('.selector.product-properties'));
                properties(propertyArray, 0, $(productItem).find('.selector.product-properties'));
                form.render('select');
            });

            $('.products-container').on('click', 'select', function () {
                let index = $(this).val();
                console.log('------------ category ---------', index)
                let selector = categorySelector(index);
                let productItem = $(this).parent('.product-item');
                console.log('------------ product item ---------', productItem, $(productItem).find('.selector.product-properties'));
                $($(productItem).find('.selector.product-categories')).html(selector);
                let propertyArray = classification['categories'][0]['properties'];
                properties(propertyArray, 0, $(productItem).find('.selector.product-properties'));
                form.render('select');
            });

            function childCategorySelector(children) {
                if(children.length > 0) {
                    let selectorBegin = "<select class=\"layui-select child-category-id\">";
                    let options = "";
                    let selectorEnd = "</select>";

                    return selectorBegin + options + selectorEnd;
                }else{
                    return '';
                }
            }

            function properties(list, selectedIndex = 0, parent = null) {
                let selectorBegin = "<select class=\"layui-select\">";
                let options = "";
                let selectorEnd = "</select>";
                console.log('----- parent -----', list);
                if(list && list.length > 0 && parent){
                    let selector = '';
                    for (let i = 0; i < list.length; i ++) {
                        selector += '<select class="layui-select select-property">';
                        for(let k = 0; k < list[i]['value'].length; k ++){
                            selector += `<option ${k === selectedIndex ? 'selected' : ''} value="${k}">${list[i]['value'][k]['title']}</option>`;
                        }
                        selector += '</select>';
                    }
                    return $(parent).html(selector);
                }else if(parent){
                    return $(parent).html(selectorBegin + options + selectorEnd);
                }
                return selectorBegin + options + selectorEnd;
            }

            function historyProductItemRender(product) {
                return `
                <div class="product-item product-item-${product['id']}" style="display: flex !important;position: relative;" data-product-id="${product['id']}">
                    <div class="product-left">
                        <div class="img-box">
                            <img src="${product['image']}">
                        </div>
                    </div>
                    <div class="product-right">
                        <div class="product-item-desc category flex">
                            <div class="title">
                                <span class="required-icon">*</span>商品类别：
                            </div>
                            <div class="selector product-categories layui-select-group flex">
                                ${categorySelector()}
                            </div>
                            <input type="number" name="num" required lay-verify="required" placeholder="数量"
                                   class="layui-input" style="width: 64px;margin-left: 12px;">
                        </div>
                        <div class="product-item-desc property flex">
                            <div class="title">
                                <span class="required-icon">*</span>商品属性：
                            </div>
                            <div class="selector product-properties layui-select-group flex">
                              ${properties()}
                            </div>
                        </div>
                        <div class="product-item-desc product-name flex">
                            <div class="title">
                                <span class="required-icon">*</span>商品型号：
                            </div>
                            <div class="selector layui-select-group">
                                <input class="title layui-input " name="title" type="text" required lay-verify="required" placeholder="商品型号">
                            </div>
                        </div>
                        <div class="product-item-desc requirement flex">
                            <div class="title">
                                <span class="required-icon">*</span>服务要求：
                            </div>
                            <div class="selector layui-select-group">
                                <select class="layui-select"></select>
                            </div>
                        </div>
                        <div class="product-item-desc spec-requirement flex">
                            <div class="title">
                                特殊要求：
                            </div>
                            <div class="selector layui-select-group">
                                <textarea name="spec_desc" type="text" class="layui-textarea" style="with:416px !important;"></textarea>
                            </div>
                        </div>
                    </div>
                    <div  class="remove-btn"><i class="layui-icon layui-icon-delete"></i></div>
                </div>`;
            }

            function noHistoryProductRender() {
                return '';
            }
            let productItemRender = null;
            $(document).on('click', '.service-type-btn', function () {
                $('.service-type .service-type-btn').removeClass('service-type-selected');
                $(this).addClass('service-type-selected');
                $('.service-type-btn .selected-icon').remove();
                $(this).append(`<div class="selected-icon">
                    <i class="icon layui-icon layui-icon-ok"></i>
                </div>`);
                $('.products-container').removeClass('hidden');
                let useHistory = $(this).data('use-history');

                if(useHistory) {
                    // $('.add-product').attr('data-target', '#productSelector');
                    $('.add-product').attr('data-toggle', 'modal');
                    $('.add-product').removeClass('add-product-item');
                    productItemRender = historyProductItemRender;
                }else{
                    // $('.add-product').removeAttr('data-target');
                    $('.add-product').removeAttr('data-toggle');
                    $('.add-product').addClass('add-product-item');
                    productItemRender = noHistoryProductRender;
                }

                orderInfo['service_type_id'] = $(this).data('id');
                orderInfo['products'] = productsDict[orderInfo['service_type_id']] ? productsDict[orderInfo['service_type_id']] :
                    (productsDict[orderInfo['service_type_id']] = []);
                renderProductsList(orderInfo['products'], productItemRender);
            });

            $(document).on('click', '.add-product[data-toggle="modal"]', function () {
                $('#productSelector').modal('show');
                $(document).trigger('RefreshSelector', [
                    orderInfo['service_type_id'],
                    orderInfo['classification_id']
                ]);
            });

            $('document').on('mouseenter', '.service-type-btn', function () {

            });

            $(document).on('click', '.remove-btn', function () {
                let item = $(this).closest('.product-item');
                let productId = $(item).data('product-id');
                console.log('.product-item-'+productId);
                let product = _.find(orderInfo['products'], {id: productId});
                let index = orderInfo['products'].indexOf(product);
                orderInfo['products'].splice(index, 1);
                $(document).trigger('RemoveProduct', [productId]);
                renderProductsList(orderInfo['products'], productItemRender);
            });

            $(document).on('AddProductEvent', function (event, serviceId, selectedProducts) {
                orderInfo['products'] = productsDict[serviceId] = [];

                for (let key in selectedProducts) {
                    productsDict[serviceId].push(selectedProducts[key]);
                }
                console.log('-------------', productsDict, serviceId);
                renderProductsList(orderInfo['products'], productItemRender);
            });
        });
    });
</script>
