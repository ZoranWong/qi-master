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
    .customer-address {
        margin-top: 12px;
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
                    <select class="layui-select master-selector" lay-search placehodler="请选择指定订单师父"></select>
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
                   <input name="customer_info[name]"class="layui-input customer-name" placeholder="请输入客户姓名">
                </div>
            </div>
            <div class="q-form-item flex">
                <div class="q-form-item-left q-form-label">
                    <span class="required-icon">*</span>
                    <span>客户号码：</span>
                </div>
                <div class="q-form-item-right">
                    <input name="customer_info[phone]" class="layui-input customer-mobile" placeholder="请输入客户号码">
                </div>
            </div>
            <div class="q-form-item flex">
                <div class="q-form-item-left q-form-label">
                    <span class="required-icon">*</span>
                    <span>客户地址：</span>
                </div>
                <div class="q-form-item-right">
                    <div class="area-selector flex">
                        <select name="customer_info[province]" class="layui-select provinces" lay-filter="province">
                            @foreach($provinces as $provinceIndex => $province)
                                <option value="{{$provinceIndex}}">{{$province['name']}}</option>
                            @endforeach
                        </select>
                        <select name="customer_info[city]" class="layui-select cities" lay-filter="city" placehodler="选择城市">
                            @foreach($provinces[0]['children'] as $cityIndex => $city)
                                <option value="{{$cityIndex}}">{{$city['name']}}</option>
                            @endforeach
                        </select>
                        <select name="customer_info[area]" class="layui-select areas" lay-filter="area" disabled placehodler="选择区域">
                        </select>
                    </div>
                    <input name="customer_info[address]" class="layui-input customer-address" placeholder="请输入客户地址">
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
                    <input name="shipping_info[company]" c class="layui-input shopping-company" placeholder="请输入物流公司">
                </div>
            </div>
            <div class="q-form-item flex">
                <div class="q-form-item-left q-form-label">
                    <span class="required-icon">*</span>
                    <span>物流单号：</span>
                </div>
                <div class="q-form-item-right">
                    <input name="shipping_info[order_no]" class="layui-input shipping-order-no" placeholder="请输入物流单号">
                </div>
            </div>
            <div class="q-form-item flex">
                <div class="q-form-item-left q-form-label">
                    <span class="required-icon">*</span>
                    <span>提货地址：</span>
                </div>
                <div class="q-form-item-right">
                    <input name="shipping_info[address]" class="layui-input shipping-address" placeholder="请输入提货地址">
                </div>
            </div>
            <div class="q-form-item flex">
                <div class="q-form-item-left q-form-label">
                    <span class="required-icon">*</span>
                    <span>提货电话：</span>
                </div>
                <div class="q-form-item-right">
                    <input name="shipping_info[phone]" class="layui-input shipping-phone-no" placeholder="请输入提货电话">
                </div>
            </div>
            <div class="q-form-item flex">
                <div class="q-form-item-left q-form-label">
                    <span class="required-icon">*</span>
                    <span>包装件数：</span>
                </div>
                <div class="q-form-item-right">
                    <input name="shipping_info[pack_num]" class="layui-input pack-number" placeholder="请输入包装件数">
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
                    <input name= "service_date" class="layui-input" id="serviceDate">
                </div>
            </div>
            <div class="q-form-item flex">
                <div class="q-form-item-left q-form-label">
                    <span class="required-icon">*</span>
                    <span>备注：</span>
                </div>
                <div class="q-form-item-right">
                    <textarea  name="remark" type="text" class="layui-textarea" style="with:416px !important;"></textarea>
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
                    <input name="contact_user_name" class="layui-input customer-real-name" placeholder="请输入真实姓名">
                </div>
            </div>
            <div class="q-form-item flex">
                <div class="q-form-item-left q-form-label">
                    <span class="required-icon">*</span>
                    <span>联系电话：</span>
                </div>
                <div class="q-form-item-right">
                    <input name="contact_user_phone" class="layui-input contact-phone-number" placeholder="请输入联系电话">
                </div>
            </div>
        </div>
    </div>
    <div class="next-opt">
        <p>还差一步，继续完善订单详细信息，就能成功发单了！</p>
        <div class="layui-btn layui-btn-primary pre-btn">上一步</div>
        <div class="layui-btn layui-btn-primary next-btn">下一步</div>
    </div>
</div>
<script>
$(function () {
   layui.use(['form', 'laydate'], function () {
       var laydate = layui.laydate;
       let regions = {!! $provinces !!};
       let province = regions[0];
       let city = null;
       let area = null;
       //执行一个laydate实例
       laydate.render({
           elem: '#serviceDate' //指定元素
       });
       let form = layui.form;
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

       $('.step.step-2 .pre-btn').click(function () {
           $('.step.step-1.step-form').removeClass('hidden');
           $('.step.step-2.step-form').addClass('hidden');
           $('.schedule .step.step-2').removeClass('active');
           $('.schedule .schedule-line').addClass('step-1');
           $('.schedule .schedule-line').removeClass('step-2');
       });
       let masterSearch = null;
       let lock = true;
       $(document).on('compositionstart', '.order-master input', function(){
           lock = true;
       });
       $(document).on('compositionend', '.order-master input', function(){
           $(this).blur();
           lock = false;
           searchMaster(masterSearch);
       });

       $(document).on('keydown', '.order-master input', function(event){
           if(event.keyCode == 13){
               searchMaster(masterSearch);
           }
       });


       $(document).on('input change', '.order-master input', function () {
           masterSearch = $(this).val();
       });


       function searchMaster(search) {
           let url = '{{$masterSearchUrl}}&search=' + search;
           $.get({
               url: url,
               success: function (masters) {
                   let options = '';
                   for(let i in masters) {
                       let master = masters[i];
                       options += `<option value="${master['id']}" >${master['real_name']}(${master['mobile']})</option>`;
                   }
                   console.log('++++++++++++', options);
                   $('.order-master select').html(options);
                   form.render();
               },
               fail: function () {

               }
           })
       }

       function validate(data) {
           return true;
       }

       form.on('select(province)', function (data) {
           let provinceIndex = data['value'];
           province = regions[provinceIndex];
           let cities = province['children'];
           let citiesOptions = regionsRender(cities);
           $('.area-selector select.cities').html(citiesOptions);
           $('.area-selector select.areas').html('');
           form.render();
           orderInfo['customer_info']['province_code'] = province['region_code'];
           orderInfo['customer_info']['province'] = province['name'];
       });

       function regionsRender(regions)
       {
           let options = '';
           for (let i in regions) {
               options += `<option value="${i}">${regions[i]['name']}</option>`;
           }

           return options;
       }

       form.on('select(city)', function (data) {
           let cityIndex = data['value'];
           city = province['children'][cityIndex];
           let options = regionsRender(city['children']);
           $('.area-selector select.areas').html(options);
           $('.area-selector select.areas').prop('disabled', false);
           form.render();
           orderInfo['customer_info']['city_code'] = city['region_code'];
           orderInfo['customer_info']['city'] = city['name'];
       });

       form.on('select(area)', function (data) {
           let areaIndex = data['value'];
           area = city['children'][areaIndex];
           orderInfo['customer_info']['area_code'] = area['region_code'];
           orderInfo['customer_info']['area'] = area['name'];
       });

       $(document).on('input change', '.step-2 input', function () {
           let value = $(this).val();
           let key = $(this).attr('name');
           orderInfo[key] = value;
           console.log('-----order info-----', orderInfo);
       });
       let orderCreateUrl = "{{$publishOrder}}";
       $(document).on('click', '.step-2 .next-btn', function () {
           if(validate(orderInfo)) {
               $.post({
                   url: orderCreateUrl,
                   data: orderInfo,
                   success(){
                       $('.step.step-2.step-form').addClass('hidden');
                       $('.step.step-3.step-form').removeClass('hidden');
                       $('.schedule .step.step-3').addClass('active');
                       $('.schedule .schedule-line').removeClass('step-2');
                       $('.schedule .schedule-line').addClass('step-3');
                   },
                   fail(){

                   }
               });
           }
       });
   });
});
</script>
