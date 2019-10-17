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
                    'register' => 'SMS_169980067',
                    'login' => 'SMS_157075027',
                    'reset_password' => 'SMS_169980066',
                    'reset_payment_password' => 'SMS_174989720'
                ]
            ],
        ]
    ]
];