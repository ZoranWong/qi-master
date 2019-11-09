<?php

namespace App\Http\Controllers;

use App\Models\Master;
use App\Models\OfferOrder;
use App\Models\Order;
use App\Models\PaymentOrder;
use App\Models\User;
use Endroid\QrCode\Factory\QrCodeFactory;
use Endroid\QrCode\QrCode;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Omnipay\Alipay\AbstractAopGateway;
use Omnipay\Common\AbstractGateway;
use Omnipay\Common\Message\AbstractRequest;
use Omnipay\Common\Message\AbstractResponse;
use Omnipay\WechatPay\Gateway;
use Omnipay\WechatPay\Message\CreateOrderResponse;

class PaymentController extends Controller
{

    public function charge()
    {
        $data = [
            'type' => PaymentOrder::TYPE_RECHARGE,
            'amount' => request('amount'),
            'pay_type' => request('pay_type'),
            'master_id' => 0,
            'order_id' => 0,
            'offer_order_id' => 0,
            'status' => PaymentOrder::STATUS_UNPAID,
            'user_id' => auth()->id()
        ];

        $order = PaymentOrder::create($data);
        if (!$order) {
            $this->response->errorInternal('失败');
        }

        if ($order->payType == PaymentOrder::PAY_TYPE_AL) {
            return $this->aliPay($order);
        } elseif ($order->payType == PaymentOrder::PAY_TYPE_WX) {
            return $this->wxPay($order);
        }
    }

    public function balancePay(PaymentOrder $order)
    {
        try {
            $user = auth()->user();
            if ($order->type === PaymentOrder::PAY_TYPE_BALANCE && $order->amount < $user->balance) {
                $user->balance -= $order->amount;
                $user->save();
                $order->status = PaymentOrder::STATUS_PAID;
                $order->save();
                return $this->response->noContent();
            }
        } catch (\Exception $exception) {
            $this->response->errorInternal('失败');
        }
    }

    public function wxPay(PaymentOrder $order)
    {
        $gateway = request('gateway', 'Native');
        $orderPayData = [
            'body' => 'The test order',
            'out_trade_no' => $order->code.Str::random(5),
            'total_fee'         => $order->amount * 100, //=0.01
            'spbill_create_ip' => request()->ip(),
            'fee_type' => 'CNY',
            'notify_url' => route('pay.notify', ['order' => $order->id, 'payType' => 'wx'])."?gateway={$gateway}"
        ];



        /**
         * @var CreateOrderResponse $response
         * */
        $response = $this->pay('WxPay', $gateway, $orderPayData);

        switch ($gateway) {
            case "Js":
                $data = $response->getJsOrderData();
                return $this->response->array([
                    'js_payment_data' => $data
                ]);
                break;
            case 'Native':
                $data = $response->getCodeUrl();
                if($response->isSuccessful()) {
                    $qrCode = app(QrCodeFactory::class)->create($data);
                    return $this->response()->created()
                        ->header('Content-Type', $qrCode->getContentType())
                        ->setContent($qrCode->writeString());
                }else{
                    return $this->response->array($response->getData());
                }

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
        $gateway = request('gateway', 'AopPage');
        $orderPayData = [
            'biz_content' => [
                'subject' => 'test',
                'out_trade_no' => $order->code,
                'total_amount' => $order->amount,
                'product_code' => 'FAST_INSTANT_TRADE_PAY',
                'notify_url' => route('pay.notify', ['order' => $order->id, 'payType' => 'ali'])."?gateway={$gateway}"
            ]
        ];

        /**
         * @var  \Omnipay\Alipay\Responses\AbstractResponse $response
         * */
        $response = $this->pay('AliPay', $gateway, $orderPayData);
        switch ($gateway) {
            case 'AopPage':
                $url = $response->getRedirectUrl();
                if($response->isSuccessful()) {
                    return redirect($url);
                }else{
                    return $this->response->array($response->getData());
                }
            default:
                $data = $response->getData();
                return $this->response->array([
                    'payment_data' => $data
                ]);

        }

    }

    public function offerOrderCreatePayOrder($offerOrder)
    {
        $offerOrder = OfferOrder::find($offerOrder);
        $order = new PaymentOrder();
        $order->amount = $offerOrder->quotePrice;
        $order->masterId = $offerOrder->masterId ?? 0;
        $order->userId = $offerOrder->userId;
        $order->orderId = $offerOrder->orderId;
        $order->status = PaymentOrder::STATUS_UNPAID;
        $order->type = PaymentOrder::TYPE_QUOTE_ORDER;
        $order->orderId = $offerOrder->orderId;
        $order->offerOrderId = $offerOrder->id;
        $order->save();
        return $this->response->array(['pay_order_id' => $order->id]);
    }


    public function unionPay(PaymentOrder $order)
    {
        $orderPayData = [
            'orderId' => $order->code, //Your order ID
            'txnTime' => date('YmdHis'), //Should be format 'YmdHis'
            'orderDesc' => 'My order title', //Order Title
            'txnAmt' => $order->amount, //Order Total Fee
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
        $request = $gateway->purchase($order);
        $response = $request->send();
        return $response;
    }

    public function notify($payType, $orderId)
    {
        switch ($payType) {
            case 'wx':
                $payType = 'WxPay';
                break;
            case 'ali':
                $payType = 'AliPay';
                break;
        }
        $gateway = request('gateway', 'Native');
        /**@var Gateway|AbstractAopGateway|AbstractGateway $notifyGateway */
        $notifyGateway = app($payType, [$gateway]);
        $data = $this->notifyData();
        $response = $notifyGateway->completePurchase([
            'request_params' => $data
        ])->send();
        if($response->isPaid()) {
            $this->orderPaidSuccess(PaymentOrder::find($orderId), $payType);
            die('success');
        }else{
            $this->orderPaidFail(PaymentOrder::find($orderId));
            die('failed');
        }

    }

    protected function notifyData()
    {
        $data = array_merge($_POST, $_GET);

        if (empty($data)) {
            $data = file_get_contents('php://input');
        }

        if (empty($data)) {
            $data = $_REQUEST;
        }
        return $data;
    }

    protected function orderPaidSuccess(PaymentOrder $order, $payType)
    {
        if ($order->type === PaymentOrder::TYPE_RECHARGE) {
            $order->user->balance += $order->amount;
            $order->user->save();
        }
        $offerOrder = OfferOrder::find($order->offerOrderId);
        $offerOrder->status = OfferOrder::STATUS_HIRED;
        $offerOrder->save();
        switch ($payType) {
            case 'WxPay':
                $payType = PaymentOrder::PAY_TYPE_WX;
                break;
            case "AliPay":
                $payType = PaymentOrder::PAY_TYPE_AL;
                break;
        }
        $order->order->status = Order::ORDER_PROCEEDING_WAIT_PRE_APPOINT;
        $order->order->orderCheckedCode = random_int(100000, 999999);
        $order->order->totalAmount += $order->amount;
        $order->payType = $payType;
        $order->save();
        $order->order->save();
        if($order->type === PaymentOrder::TYPE_QUOTE_ORDER) {
            app('sms')->sendSms($order->master->mobile, 'remind_reserved', [
                'master' => $order->master->realName ? $order->master->realName : $order->master->name,
                'orderNo' => $order->order->orderNo
            ]);
        }elseif($order->type === PaymentOrder::TYPE_ADDITION_ORDER) {
            app('sms')->sendSms($order->master->mobile, 'addition_fee', [
                'master' => $order->master->realName ? $order->master->realName : $order->master->name,
                'user' => $order->user->realName ? $order->user->realName : $order->user->name,
                'fee' => $order->amount
            ]);
        }
    }

    protected function orderPaidFail(PaymentOrder $order)
    {
    }
}
