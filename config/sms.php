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
                    'register' => 'SMS_174900588',
                    'login' => 'SMS_174900590',
                    'reset_password' => 'SMS_174900587',
                    'reset_payment_password' => 'SMS_174989720',
                    'order_check_code' => 'SMS_174900586'
                ]
            ],
        ]
    ]
];
