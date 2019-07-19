{{--模态框（Modal）--}}
<style>
    .modal-dialog {
        max-width: 856px;
        margin: 6.75rem auto;
    }

    .modal-header {
        padding-bottom: 0;
    }

    .modal-body {
        display: flex;
    }

    .modal-body .left-part {
        width: 20%;
        border-right: #c5c5c5 1px solid;
    }

    .modal-body .right-part {
        width: 80%;
    }

    .search-form {
        display: flex;
        align-items: start;
        margin-left: 32px;
    }

    .tab {
        margin: 0;
    }

    .tab-title {
        padding: 18px 24px 6px;
        cursor: pointer;
    }

    .tab-title.active {
        border-bottom: #fe8f00 1px solid;
        color: #fe8f00;
    }

    .tab-item {
        width: 100%;
    }

    .tab-content {
        height: 496px;
    }

    .category-item.active {
        color: #fe8f00;
    }

    .category-item {
        padding: 6px;
        cursor: pointer;
    }

    .category-item:hover {
        color: #fe8f00;
    }

    .search-form .tips {
        font-size: 12px;
        width: 523px;
        vertical-align: middle;
        text-align: center;
        margin-top: 18px;
    }

    #productSelector .product-list {
        height: 406px;
        margin: 12px;
    }

    #productSelector .product-list ul {
        display: flex;
        flex-wrap: wrap;
        flex-flow: wrap;
        flex-direction: row;
    }

    .product-list .product-card {
        margin: 8px;
        display: inline;
        list-style-type: none;
        white-space: nowrap;
        overflow: hidden;
    }

    .product-card .product-img {
        width: 86px;
        height: 86px;
        position: relative;
    }

    .product-card .product-name {
        text-align: center;
        font-size: 12px;
    }

    .product-card .selector {
        position: absolute;
        bottom: 0;
        right: 6px;
        color: #ffffff;
    }

    .product-card .selector .layui-icon {
        font-size: 18px;
    }

    .product-card.active .selector .layui-icon, .product-card.active .product-name {
        color: #fe8f00;
    }

    .tab-item.upload-item {
        text-align: center;
        margin-top: 128px;
        margin-bottom: 12px;
    }

    .upload-file-box {
        text-align: center;
        width: 82px;
        margin-bottom: 12px;
    }

    .upload-file-box .layui-icon-upload {
        color: #fe8f00;
    }

    .upload-file-box .tips p {
        color: #fe8f00;
        font-size: 12px;
    }

    .tab-item .comments {
        text-align: center;
        font-size: 12px;
    }

    #productPage {
        position: absolute;
        right: 54px;
        bottom: 6px;
    }
</style>
<div class="modal fade" id="productSelector" tabindex="-1" role="dialog" aria-labelledby="productSelectorLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="layui-tab modal-content">
            <div class="modal-header">
                <ul class="flex tab">
                    <li class="tab-title active">商品图库</li>
                    <li class="tab-title ">本地上传</li>
                </ul>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="tab-content modal-body">
                <div class="tab-item flex ">
                    <div class="left-part">
                        <ul class="categories-list">
                        </ul>
                    </div>
                    <div class="right-part">
                        <div class="search-form">
                            <input class="layui-input search-input" placeholder="请输入商品型号查找商品"/>
                            <div class="layui-btn layui-btn-primary search-btn">搜索</div>
                            <span class="tips">（注：商品图片可点击进行多选）</span>
                        </div>
                        <div class="product-list">
                            <ul>
                            </ul>
                        </div>
                        <div id="productPage"></div>
                    </div>
                </div>
                <div class="tab-item upload-item hidden" id="uploadProduct">
                    <div class="upload-file-box layui-upload-drag">
                        <i class="layui-icon layui-icon-upload"></i>
                        <div class="tips"><p>上传本地图片</p></div>
                    </div>
                    <div class="comments">
                        <p>1.选择本地上传，商品图库已选中的商品将不会被添加。</p>
                        <p>2.本地上传的图片，在订单发布成功后会进入商品图库。</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="layui-btn layui-btn-primary" data-dismiss="modal">取消</button>
                <button type="button" class="layui-btn layui-btn-primary layui-bg-blue add-product-event-btn">确定</button>
            </div>

        </div>
    </div><!-- /.modal -->
</div>
<script>
    $(function () {
        layui.use(['laypage', 'upload'], function () {
            let classifications = {!! $classifications !!};
            let laypage = layui.laypage;
            let upload = layui.upload; //得到 upload 对象
            let search = '';
            let page = 1;
            let categoryId = '';
            let selectedProducts = {};
            let serviceId = null;
            let selectedDict = {};
            upload.render({
                elem: '#uploadProduct'
                ,url: '{{$productUpload}}'
                ,done: function(res, index, upload){ //上传后的回调
                    $('#productSelector').modal('hide');
                    let id = 'NP' + Math.random() * 10000;
                    if(selectedDict && typeof selectedDict[serviceId] === 'undefined'){
                        selectedDict[serviceId] = {};
                    }
                    selectedProducts = selectedDict[serviceId];
                    selectedProducts[id] = {image: res.path, id: id, np: true};
                    $(document).trigger('AddProductEvent', [serviceId, selectedProducts]);
                }
                //,accept: 'file' //允许上传的文件类型
                //,size: 50 //最大允许上传的文件大小
                //,……
            })
            function refreshProductsPanel(limit = 18) {
                $.get({
                    url: "{{$productsUrl}}&category_id="+categoryId+ "&service_id=" + serviceId +"&page=" + page + "&search=" + search + "&limit=" + limit,
                    success: function (res) {
                        refreshProducts(res.data, res.meta.pagination);
                    },
                    fail: function () {
                    }
                });
            }
            function paginatorRender(count, limit, page) {
                laypage.render({
                    elem: 'productPage', //注意，这里的 test1 是 ID，不用加 # 号
                    count: count, //数据总数，从服务端得到
                    limit: limit,
                    curr: page
                });
            }
            function productsRender(products) {
                let count = products.length;
                let html = '';
                for (let i = 0; i< count; i ++) {
                    html += productRender(products[i]);
                }

                $("#productSelector .product-list>ul").html(html);
            }

            function productRender(product) {
                let productJson = JSON.stringify(product);
                let active = selectedProducts[product['id']] ? "active" : "";
                return `
                <li class="product-card ${active}" data-product='${productJson}'>
                    <div class="product-img">
                        <img src="${product['image']}">
                        <div class="selector">
                            <i class="layui-icon layui-icon-ok-circle"></i>
                        </div>
                    </div>
                    <div class="product-name">${product['title']}</div>
                </li>
                `;
            }
            function refreshProducts(products, paginator) {
                productsRender(products);
                paginatorRender(paginator['total'], paginator['per_page'], paginator['current_page'])
            }

            //执行一个laypage实例
            laypage.render({
                elem: 'productPage', //注意，这里的 test1 是 ID，不用加 # 号
                count: 90, //数据总数，从服务端得到
                limit: 18
            });
            $('.tab-title').click(function () {
                $('.tab-title').removeClass('active');
                $(this).addClass('active');
                $('.tab-item').addClass('hidden');
                $($('.tab-item').get($(this).index())).removeClass('hidden');
                $('.modal-footer').toggleClass('hidden');
            });
            $(document).on('click', '.category-item', function () {
                $('.category-item').removeClass('active');
                $(this).addClass('active');
                search = '';
                categoryId = $(this).data('category-id');
                page = 1;
                refreshProductsPanel();
            });
            $(document).on('click', '.product-card', function () {
                $(this).toggleClass('active');
                console.log($(this).data('product'));
                let product = ($(this).data('product'));

                if(selectedDict && typeof selectedDict[serviceId] === 'undefined'){
                    selectedDict[serviceId] = {};
                }
                selectedProducts = selectedDict[serviceId];
                console.log('------------', serviceId, selectedDict[serviceId]);
                if(typeof selectedProducts[product['id']] !== 'undefined') {
                    delete selectedProducts[product['id']];
                }else{
                    selectedProducts[product['id']] = product;
                }

            });
            $('.add-product-event-btn').click(function () {
                $('#productSelector').modal('hide');
                $(document).trigger('AddProductEvent', [serviceId, selectedProducts]);
            });
            $(".search-btn").click(function () {
                search = $('.search-input').val();
                page = 1;
                refreshProductsPanel();
            });

            $(document).on('click', '.layui-laypage>a', function () {
                console.log('----------------+++++++--------------');
                page = $(this).data('page');
                refreshProductsPanel();
            });

            function categoryListRender (categories) {
                let html = '';
                let count = categories.length;
                for(let i =0; i < count; i ++){
                    html += `<li class="category-item" data-idx="${i}" data-category-id="${categories[i]['id']}">${categories[i]['name']}</li>`;
                }

                $('#productSelector .categories-list').html(html);
                $('#productSelector .categories-list .category-item[data-idx="0"]').trigger('click');
            }

            $(document).on('RefreshSelector', function (event, serviceTypeId, classificationId) {
                let classification = _.find(classifications, {id: classificationId});
                serviceId = serviceTypeId;
                categoryListRender(classification['top_categories']);
            });

            $(document).on('RemoveProduct', function (event, productId) {
                delete selectedProducts[productId];
            });
        });
    });
</script>
