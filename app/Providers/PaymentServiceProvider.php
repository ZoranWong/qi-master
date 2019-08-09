<?php

namespace App\Providers;

use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Omnipay\Alipay\AbstractAopGateway;
use Omnipay\Alipay\AopAppGateway;
use Omnipay\Alipay\AopF2FGateway;
use Omnipay\Alipay\AopJsGateway;
use Omnipay\Alipay\AopPageGateway;
use Omnipay\Alipay\AopWapGateway;
use Omnipay\UnionPay\ExpressGateway;
use Omnipay\UnionPay\LegacyMobileGateway;
use Omnipay\UnionPay\LegacyQuickPayGateway;
use Omnipay\UnionPay\WtzGateway;
use Omnipay\WechatPay\AppGateway;
use Omnipay\WechatPay\Gateway;
use Omnipay\WechatPay\JsGateway;
use Omnipay\WechatPay\MwebGateway;
use Omnipay\WechatPay\NativeGateway;
use Omnipay\WechatPay\PosGateway;

class PaymentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $omnipayConfig = config('omnipay');
        $omnipay = app('omnipay');
        //
        //gateways: WechatPay_App, WechatPay_Native, WechatPay_Js, WechatPay_Pos, WechatPay_Mweb
        $this->app->singleton('WxPay', function (Application $app, $params = ['Js']) use ($omnipayConfig, $omnipay){
            list($type) = $params;
            $config = $omnipayConfig['gateways']['WechatPay'];
            $gateway = $omnipay->gateway("WechatPay_{$type}");
            /**@var JsGateway|NativeGateway|PosGateway|AppGateway|MwebGateway $gateway*/
            $gateway->setAppId($config['app_id']);
            $gateway->setApiKey($config['api_key']);
            $gateway->setMchId($config['mch_id']);
            $gateway->setCertPath(storage_path($config['cert_path']));
            $gateway->setKeyPath(storage_path($config['key_path']));
            $gateway->setCurrency($config['currency']);
            if(method_exists($gateway, 'setReturnUrl'))
                $gateway->setReturnUrl($config['return_url']);
            $notify = "{$config['notify_url']}?pay_type=WxPay&gateway={$type}";
            $gateway->setNotifyUrl($notify);
            return $gateway;
        });
        //gateways: AliPay_AopPage, AliPay_AopApp, AliPay_AopF2F, AliPay_AopJs, AliPay_AopWap
        $this->app->singleton('AliPay', function (Application $app, $params = ["AopPage"]) use ($omnipayConfig, $omnipay) {
            $config = $omnipayConfig['gateways']['AliPay'];
            list($type) = $params;
            /**@var AopPageGateway|AopAppGateway|AopF2FGateway|AopJsGateway|AopWapGateway $gateway*/
            $gateway = $omnipay->gateway("Alipay_{$type}");
            $gateway->setSignType($config['sign_type']); // RSA/RSA2/MD5
            $gateway->setAppId($config['app_id']);
            $privateKey = file_get_contents(storage_path($config['private_key_path']));
            $gateway->setPrivateKey($privateKey);
            $publicKey = file_get_contents(storage_path($config['public_key_path']));
            $gateway->setAlipayPublicKey($publicKey);
            if(method_exists($gateway, 'setReturnUrl'))
                $gateway->setReturnUrl($config['return_url']);
            $notify = "{$config['notify_url']}?pay_type=AliPay&gateway={$type}";
            $gateway->setNotifyUrl($notify);
            return $gateway;
        });
        //gateways: UnionPay_Express, UnionPay_Wtz, UnionPay_LegacyMobile, UnionPay_LegacyQuickPay
        $this->app->singleton('UnionPay', function (Application $app, $params = "Express") use ($omnipayConfig, $omnipay) {
            $config = $omnipayConfig['gateways']['UnionPay'];
            list($type) = $params;
            /**@var ExpressGateway|WtzGateway|LegacyMobileGateway|LegacyQuickPayGateway $gateway*/
            $gateway = $omnipay->gateway("UnionPay_{$type}");
            $gateway->setMerId($config['mer_id']);
            $gateway->setCertId($config['cert_id']);
            $gateway->setPrivateKey($config['private_key']);
            $gateway->setReturnUrl($config['return_url']);
            $notify = "{$config['notify_url']}?pay_type=UnionPay&gateway={$type}";
            $gateway->setNotifyUrl($notify);
            return $gateway;
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
