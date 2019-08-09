<?php

return [
    /** The default gateway name */
    'gateway' => 'PayPal_Express',

    /** The default settings, applied to all gateways */
    'defaults' => [
        'testMode' => false,
    ],

    /** Gateway specific parameters */
    'gateways' => [
        'PayPal_Express' => [
            'username' => '',
            'landingPage' => ['billing', 'login'],
        ],
        'WechatPay' => [
            'app_id' => env('WX_PAY_APP_ID', null),
            'mch_id' => env('WX_PAY_MCH_ID', null),
            'api_key' => env('WX_PAY_API_KEY', null),
            'cert_path' => env('WX_PAY_CERT_PATH', null),
            'key_path' => env('WX_PAY_KEY_PATH', null),
            'return_url' =>env('WX_PAY_RETURN_URL', null),
            'notify_url' => env('WX_PAY_NOTIFY_URL', null),
            'currency' => env('WX_PAY_CURRENCY_TYPE', 'CNY')
        ],
        'AliPay' => [
            'app_id' => env('ALI_PAY_APP_ID', null),
            'sign_type' => env('ALI_PAY_SIGN_TYPE', null),
            'return_url' => env('ALI_PAY_RETURN_URL', null),
            'notify_url' => env('ALI_PAY_NOTIFY_URL', null),
            'private_key_path' => env('ALI_PAY_PRIVATE_KEY_PATH', null),
            'public_key_path' => env('ALI_PAY_PUBLIC_KEY_PATH', null),
            'return_raw' => env('ALI_PAY_RETURN_RAW', null),
            'redirect_url' => env('ALI_PAY_REDIRECT_URL', null)

        ],
        'UnionPay' => [

        ]
    ],
];
