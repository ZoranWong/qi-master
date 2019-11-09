<?php
/**
 * Created by PhpStorm.
 * User: wangzaron
 * Date: 2019/8/16
 * Time: 7:16 PM
 */

use App\Sms\Adapters\AliyunAdapter;

return [
    'default' => env('SMS_DRIVER', 'aliyun'),
    'drivers' => [
        'aliyun' => [
            'name' => '阿里云短信',
            'adapter' => AliyunAdapter::class,
            'config' => [
                'region_id' => env('ALIYUN_SMS_REGION_ID', 'cn-hangzhou'), // regionid
                'access_key' => env('ALIYUN_SMS_AK'), // accessKey
                'access_secret' => env('ALIYUN_SMS_AS'), // accessSecret
                'sign_name' => env('ALIYUN_SMS_SIGN_NAME'), // 签名
                'templates' => [
                    'register' => 'SMS_174900588', // 注册
                    'login' => 'SMS_174900590', // 登陆
                    'reset_password' => 'SMS_174900587', // 重置密码
                    'reset_payment_password' => 'SMS_174989720', // 重置支付密码
                    'order_check_code' => 'SMS_177245800', // 订单确认码通知
                    'reserved_service' => 'SMS_177250652',// 预约成功通知
                    'complaint_handled' => 'SMS_177250649',// 投诉受理通知
                    'agreed_refund' => 'SMS_177240723', // 师傅同意退款请求后通知用户
                    'reset_reserved_service' => 'SMS_177240718', // 调整预约时间通知
                    'refunded_success' => 'SMS_177250643', // 退款成功通知
                    'twice_service' => 'SMS_177246002', // 二次上门服务通知
                    'refund_apply' => 'SMS_177250638', // 退款申请
                    'addition_fee' => 'SMS_177240711',// 追加费用通知
                    'remind_reserved' => 'SMS_177245671', // 提醒师傅预约上门时间
                    'assign_notice' => 'SMS_177255604', // 用户指派通知
                    'employ_notice' => 'SMS_177250627', // 雇佣通知
                ]
            ],
        ]
    ]
];
