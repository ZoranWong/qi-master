{{--模态框（Modal）--}}
<style>
    .modal-dialog {
        max-width: 800px;
        margin: 6.75rem auto;
    }
    .modal-header {
        padding-bottom: 0;
    }
    .layui-tab-title{
        margin-bottom: 0;
    }
    .modal-body{
        display: flex;
    }
    .modal-body .left-part {
        width: 14%;
        border-right: #929292 1px solid;
    }
    .modal-body .right-part {
        width: 86%;
    }
    .category-item {
        /*width: 124px;*/
    }
    .layui-tab-item{
        width: 100%;
    }
    .search-form {
        display: flex;
        align-items: start;
    }
    #productSelector .layui-tab-item {
        display: flex !important;
        align-items: normal;
    }
</style>
<div class="modal fade" id="productSelector" tabindex="-1" role="dialog" aria-labelledby="productSelectorLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="layui-tab modal-content">
            <div class="modal-header">
                <ul class="layui-tab-title">
                    <li class="layui-this">商品图库</li>
                    <li>本地上传</li>
                </ul>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="layui-tab-content modal-body">
                <div class="layui-tab-item layui-show flex">
                    <div class="left-part">
                        <ul class="categories-list">
                            <li class="category-item">全部(523)</li>
                            <li class="category-item">不配(523)</li>
                            <li class="category-item">府门(523)</li>
                            <li class="category-item">了吗(523)</li>
                            <li class="category-item">龙没(523)</li>
                        </ul>
                    </div>
                    <div class="right-part">
                        <div class="search-form">
                            <input class="layui-input search-input" />
                            <button class="layui-btn layui-btn-primary search-btn">搜索</button>
                        </div>
                    </div>
                </div>
                <div class="layui-tab-item">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="layui-btn layui-btn-primary" data-dismiss="modal">取消</button>
                <button type="button" class="layui-btn layui-btn-primary layui-bg-blue">确定</button>
            </div>

        </div>
    </div><!-- /.modal -->
</div>
<script>
    $(function () {
        layui.use('element', function () {

        });
    });
</script>
