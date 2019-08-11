<?php

namespace App\Http\Controllers;

use App\Models\Master;
use App\Models\Order;
use App\Models\PaymentOrder;
use App\Models\User;
use Endroid\QrCode\Factory\QrCodeFactory;
use Endroid\QrCode\QrCode;
use Omnipay\Alipay\AbstractAopGateway;
use Omnipay\Common\AbstractGateway;
use Omnipay\Common\Message\AbstractRequest;
use Omnipay\Common\Message\AbstractResponse;
use Omnipay\WechatPay\Gateway;
use Omnipay\WechatPay\Message\CreateOrderResponse;

class PaymentController extends Controller
{
    public function wxPay(PaymentOrder $order)
    {
        $orderPayData = [
            'body'              => 'The test order',
            'out_trade_no'      => $order->code,
            'total_fee'         => $order->amount * 100, //=0.01
            'spbill_create_ip'  => request()->ip(),
            'fee_type'          => 'CNY'
        ];

        $gateway = request('gateway', 'Native');
        /**
         * @var CreateOrderResponse $response
         * */
        $response = $this->pay('WxPay', $gateway, $orderPayData);
        switch ($gateway) {
            case "Js":
                $data =  $response->getJsOrderData();
                return $this->response->array([
                    'js_payment_data' => $data
                ]);
                break;
            case 'Native':
                $data = $response->getCodeUrl();
                $qrCode = app(QrCodeFactory::class)->create($data);
                return $this->response()->created()
                    ->header('Content-Type', $qrCode->getContentType())
                    ->setContent($qrCode->writeString());
                break;
            case 'Mweb':
                $data = $response->getMwebUrl();
                return redirect($data);
                break;
            case 'App':
                $data = $response->getAppOrderData();
                return $this->response->array([
                    'app_payment_data' => $data
                ]);
                break;
            default:
                $data = $response->getData();
                return $this->response->array([
                    'payment_data' => $data
                ]);
                break;
        }

    }

    public function aliPay(PaymentOrder $order)
    {
        $orderPayData = [
            'biz_content' => [
                'subject'      => 'test',
                'out_trade_no' => $order->code,
                'total_amount' => $order->amount,
                'product_code' => 'FAST_INSTANT_TRADE_PAY',
            ]
        ];
        $gateway = request('gateway', 'AopPage');
        /**
         * @var  \Omnipay\Alipay\Responses\AbstractResponse $response
         * */
        $response = $this->pay('AliPay', $gateway, $orderPayData);
        switch ($gateway) {
            case 'AopPage':
                $url = $response->getRedirectUrl();
                return redirect($url);
            default:
                $data = $response->getData();
                return $this->response->array([
                    'payment_data' => $data
                ]);

        }

    }

    public function aliPayOrderTest()
    {
        $order = new PaymentOrder();
        $order->amount = 1;
        $order->payType = PaymentOrder::TYPE_QUOTE_ORDER;
        $order->masterId = Master::inRandomOrder()->first()->id;
        $order->userId = User::inRandomOrder()->first()->id;
        $order->orderId = Order::inRandomOrder()->first()->id;
        $order->status = PaymentOrder::STATUS_UNPAID;
        $order->save();
        request()['gateway'] = 'AopJs';
        return app(PaymentController::class)->aliPay($order);
    }

    public function wxPayOrderTest()
    {
        $order = new PaymentOrder();
        $order->amount = 1;
        $order->payType = PaymentOrder::TYPE_QUOTE_ORDER;
        $order->masterId = Master::inRandomOrder()->first()->id;
        $order->userId = User::inRandomOrder()->first()->id;
        $order->orderId = Order::inRandomOrder()->first()->id;
        $order->status = PaymentOrder::STATUS_UNPAID;
        $order->save();
//        request()['gateway'] = 'AopJs';
        return app(PaymentController::class)->wxPay($order);
    }

    public function unionPay(PaymentOrder $order)
    {
        $orderPayData = [
            'orderId'   => $order->code, //Your order ID
            'txnTime'   => date('YmdHis'), //Should be format 'YmdHis'
            'orderDesc' => 'My order title', //Order Title
            'txnAmt'    => $order->amount, //Order Total Fee
        ];
        $gateway = request('gateway', 'Express');
        /**
         * @var \Omnipay\UnionPay\Message\CreateOrderResponse $response
         * */
        $response = $this->pay('UnionPay', $gateway, $orderPayData);
        switch ($gateway) {
            case 'Express':
                $url = $response->getRedirectUrl();
                return redirect($url);
            default:
                $data = $response->getData();
                return $this->response->array([
                    'payment_data' => $data
                ]);
        }
    }

    protected function pay(string $payType, string $payGateway, array $order)
    {
        $gateway = app($payType, [$payGateway]);
        /**
         * @var AbstractRequest $request
         * @var AbstractResponse $response
         */
        $request  = $gateway->purchase($order);
        $response = $request->send();
        return $response;
    }

    public function notify()
    {
        $payType = request('pay_type', 'WxPay');
        $gateway = request('gateway', 'Native');
        /**@var Gateway|AbstractAopGateway|AbstractGateway $notifyGateway*/
        $notifyGateway = app($payType, [$gateway]);
        $data = $this->notifyData();
        $response = $notifyGateway->completePurchase([
            'request_params' => $data
        ])->send();
        if ($response->isPaid()) {
            //pay success
            $this->orderPaidSuccess();
        }else{
            //pay fail
            $this->orderPaidFail();
        }
    }

    protected function notifyData()
    {
        $data = array_merge($_POST, $_GET);

        if(empty($data)) {
            $data = file_get_contents('php://input');
        }

        if(empty($data)) {
            $data = $_REQUEST;
        }
        return $data;
    }

    protected function orderPaidSuccess()
    {

    }

    protected function orderPaidFail()
    {

    }
}
