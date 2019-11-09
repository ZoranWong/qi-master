<?php

namespace App\Api\Controllers\User;

use App\Api\Controller;
use App\Http\Requests\OrderAdditionPaymentRequest;
use App\Models\Master;
use App\Models\MasterComment;
use App\Models\OfferOrder;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\PaymentOrder;
use App\Repositories\MasterRepository;
use App\Repositories\OfferOrderRepository;
use App\Repositories\OrderRepository;
use App\Transformers\OfferOrderTransformer;
use App\Transformers\OrderDetailTransformer;
use App\Transformers\OrderTransformer;
use Dingo\Api\Http\Request;
use Dingo\Api\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class OrderController extends Controller
{
    /**
     * @var OrderRepository $repository
     */
    protected $repository;

    public function __construct(OrderRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * 订单列表
     * @return Response
     */
    public function index()
    {
        $paginator = $this->repository->getList();

        return $this->response->paginator($paginator, new OrderTransformer);
    }

    /**
     * 订单详情
     * @param Order $order
     * @return Response
     */
    public function detail(Order $order)
    {
        if (auth()->id() !== $order->userId) {
            $this->response->errorForbidden('您无权查看该订单');
        }

        $order = $this->repository->with(['comment', 'classification', 'serviceType'])->find($order->id);

        return $this->response->item($order, new OrderDetailTransformer);
    }

    /**
     * 订单报价单
     * @param Order $order
     * @return Response
     */
    public function offerOrders(Order $order)
    {
        $offerOrders = $this->repository->getOfferOrderList($order);

        return $this->response->collection($offerOrders, new OfferOrderTransformer);
    }

    /**
     * 雇佣服务商
     * 直接雇佣不需要此步骤
     * @param Order $order
     * @param Request $request
     * @param OfferOrderRepository $offerOrderRepository
     * @return Response
     * @throws ValidationException
     */
    public function hireMaster(Order $order, Request $request, OfferOrderRepository $offerOrderRepository)
    {
        $this->validate($request, [
            'offer_order_id' => 'required|int'
        ]);

        if (auth()->id() !== $order->userId) {
            $this->response->errorForbidden('您不允许对不属于您的订单进行雇佣操作');
        }

        if ($order->status !== Order::ORDER_WAIT_HIRE) {
            $this->response->errorForbidden('订单已雇佣，不允许重复报价');
        }

        $offerOrderId = $request->input('offer_order_id');

        /** @var OfferOrder $offerOrder */
        $offerOrder = $offerOrderRepository->find($offerOrderId);

        if ($offerOrder->orderId !== $order->id) {
            $this->response->errorForbidden('该报价单不属于指定订单');
        }

        $offerOrder->update(['status' => OfferOrder::STATUS_HIRED]);

        $order->offerOrders()->whereKeyNot($offerOrderId)->update(['status' => OfferOrder::STATUS_REFUSED]);
        $paymentOrder = new PaymentOrder();
        $paymentOrder->masterId = $order->masterId = $offerOrder->masterId;
        $paymentOrder->status = PaymentOrder::STATUS_UNPAID;
//        $paymentOrder->status = PaymentOrder::STATUS_PAID;
        $paymentOrder->type = PaymentOrder::TYPE_QUOTE_ORDER;
        $paymentOrder->offerOrderId = $offerOrder->id;
        $paymentOrder->amount = $offerOrder->quotePrice;
        $paymentOrder->userId = $order->userId;
        $order->payments()->save($paymentOrder);
        $order->totalAmount += $paymentOrder->amount;
//        $order->status |= Order::ORDER_EMPLOYED | Order::ORDER_PROCEEDING_WAIT_PRE_APPOINT;
        $order->status |= Order::ORDER_EMPLOYED;
        $order->save();
//        $order->update(['status' => $order->status | Order::ORDER_EMPLOYED]);
//        $order->update(['status' => $order->status | Order::ORDER_EMPLOYED | Order::ORDER_PROCEEDING_WAIT_PRE_APPOINT]);
        return $this->response->item($offerOrder, new OfferOrderTransformer);
    }

    /**
     * 发布报价招标订单
     */
    public function publish(Request $request)
    {
        Log::info('-------- order publish request --------', [$request->input()]);
        $order = new Order();
        $order->orderNo = Order::findAvailableNo();
        $order->userId = $request->user()->id;
        $order->classificationId = $request->input('classification_id');
        $order->serviceId = $request->input('service_type_id');
        $order->contactUserName = $request->input('contact_user_name');
        $order->contactUserPhone = $request->input('contact_user_phone');
        $order->customerInfo = $request->input('customer_info');
        $order->shippingInfo = $request->input('shipping_info');
        $order->products = $request->input('products');
        $order->provinceCode = $request->input('customer_info')['province_code'];
        $order->cityCode = $request->input('customer_info')['city_code'];
        $order->regionCode = $request->input('customer_info')['area_code'];
        if($order->save()) {
            return $this->response->array([
                'message'=> 'f发布成功'
            ]);
        }

        return $this->response->errorInternal('失败');
    }

    /**
     * 发布一口价订单
     */
    public function publishFixedPrice()
    {

    }

    public function masters(Request $request)
    {
        $search = $request->get('search', null);

        if($search) {
            $masters = Master::where('mobile', 'like', "%{$search}%")
                //->orWhere('name', 'like', "%{$search}%")
                ->orWhere('real_name', 'like', "%{$search}%")
                ->get();
            return $this->response->array($masters->toArray());
        }else{
            return $this->response->array([]);
        }
    }

    public function checkedOrder(Order $order)
    {
        if(app('sms')->sendSms($order->master->mobile, 'order_check_code', [
            'master' => $order->master->realName? $order->master->realName : $order->master->name,
            'orderNo' => $order->orderNo,
            'code' => $order->orderCheckedCode
        ])){
            $order->hadSendCode = true;
            $order->save();
            return $this->response->array([
                'code' => 'SUCCESS'
            ]);
        }else{
            return $this->response->array([
                'code' => 'FAIL',
                'message' => '短信发送错误'
            ]);
        }

    }

    public function commentOrder(Order $order)
    {
        $comment = new MasterComment();
        $comment->userId = auth()->user()->id;
        $comment->masterId = $order->masterId;
        $comment->content = request('content');
        $comment->type = request('type', MasterComment::TYPE_NORMAL);
        $comment->labels = request('labels', []);
        $comment->rates = request('rates');
        $order->comment()->save($comment);
        return $this->response->noContent();
    }

    public function addAdditionOrder(Order $order, OrderAdditionPaymentRequest $request)
    {
        $paymentOrder = new PaymentOrder();
        $paymentOrder->amount= $request->input('amount');
        $paymentOrder->masterId = $order->masterId;
        $paymentOrder->userId = $order->userId;
        $paymentOrder->type = PaymentOrder::TYPE_ADDITION_ORDER;
        $data = $order->payments()->save($paymentOrder);
        return $this->response->array([
            'payment_order_id' => $data->id
        ]);
    }

    public function cancelOrder(Order $order)
    {
        $order->status |= Order::ORDER_CLOSED;
        $order->save();
        return $this->response->noContent();
    }
}
