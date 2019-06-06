<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
class AddTablesComment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        DB::statement('ALTER TABLE `users` COMMENT "用户表"');
        DB::statement('ALTER TABLE `password_resets` COMMENT "密码重置表"');
        DB::statement('ALTER TABLE `admin_users` COMMENT "管理员表"');
        BD::statement('ALTER TABLE `products` COMMENT "产品表"');
        DB::statement('ALTER TABLE `user_addresses` COMMENT "用户地址"');
        DB::statement('ALTER TABLE `product_skus` COMMENT "产品标准库存表"');
        DB::statement('ALTER TABLE `user_favorite_products` COMMENT "用户常产品"');
        DB::statement('ALTER TABLE `orders` COMMENT "服务订单表"');
        DB::statement('ALTER TABLE `order_items` COMMENT "服务订单详情"');
        DB::statement('ALTER TABLE `coupon_codes` COMMENT "优惠券表"');
        DB::statement('ALTER TABLE `classifications` COMMENT "类目表"');
        DB::statement('ALTER TABLE `service_types` COMMENT "服务类型表"');
        DB::statement('ALTER TABLE `categories` COMMENT "类别表"');
        DB::statement('ALTER TABLE `brands` COMMENT "商品品牌"');
        DB::statement('ALTER TABLE `category_properties` COMMENT "商品属性"');
        DB::statement('ALTER TABLE `service_requirements` COMMENT "服务要求"');
        DB::statement('ALTER TABLE `measurements` COMMENT "度量衡"');
        DB::statement('ALTER TABLE `classification_services` COMMENT "类别服务关系表"');
        DB::statement('ALTER TABLE  `offer_orders` COMMENT "报价单"');
        DB::statement('ALTER TABLE `payment_orders` COMMENT "支付信息单"');
        DB::statement('ALTER TABLE `classification_product` COMMENT "类目产品关系表"');
        DB::statement('ALTER TABLE `category_product` COMMENT "类别产品关系"');
        DB::statement('ALTER TABLE `masters` COMMENT "师傅表"');
        DB::statement('ALTER TABLE `refund_orders` COMMENT "退款单"');
        DB::statement('ALTER TABLE `regions` COMMENT "行政区域"');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
