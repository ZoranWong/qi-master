<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">服务工单号：{{ $order->orderNo }}</h3>
        <div class="box-tools">
            <div class="btn-group float-right" style="margin-right: 10px">
                <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-default"><i class="fa fa-list"></i> 列表</a>
            </div>
        </div>
    </div>
    <div class="box-body">
        <table class="table table-bordered">
            <tbody>
            <tr>
                <td colspan="4" style="font-size: medium; font-weight: bold;">工单基础信息</td>
            </tr>
            <tr>
                <td>雇主：</td>
                <td>{{ $order->employer }}</td>
                <td>发布时间：</td>
                <td>{{$order->publishedAt}}</td>
            </tr>
            <tr>
                <td>服务单类型：</td>
                <td>{{ $order->orderType }}</td>
                <td>工单状态：</td>
                <td>{{ $order->orderStatus }}</td>
            </tr>
            </tbody>
        </table>
        <table class="table table-bordered">
            <tbody>
            <tr>
                <td colspan="5" style="font-size: medium; font-weight: bold;">工单事项详情</td>
            </tr>
            <tr>
                <td>产品</td>
                <td>服务费用</td>
                <td>额外费用</td>
                <td>服务师傅</td>
                <td>服务状态</td>
            </tr>
            @foreach($orderItems as $item)
                <tr>
                    <td>{{$item->product['title']}}</td>
                    <td>{{$item->installFeeFormat}}</td>
                    <td>{{$item->otherFeeFormat}}</td>
                    <td>{{$item->employedMasterName}}</td>
                    <td>{{$item->orderItemStatus}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <table class="table table-bordered">
            <tbody>
            <tr>
                <td colspan="5" style="font-size: medium; font-weight: bold;">师傅报价信息</td>
            </tr>
            <tr>
                <td>服务师傅</td>
                <td>服务内容</td>
                <td>报价金额(元)</td>
                <td>申请时间</td>
                <td>服务状态</td>
            </tr>
            @foreach($offerOrders as $offerOrder)
                <tr>
                    <td>{{$offerOrder->masterName}}</td>
                    <td>{{$offerOrder->serviceContent}}</td>
                    <td>{{$offerOrder->quotePriceFormat}}</td>
                    <td>{{$offerOrder->applyDate}}</td>
                    <td>{{$offerOrder->offerOrderStatus}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <table class="table table-bordered">
            <tbody>
            <tr>
                <td colspan="4" style="font-size: medium; font-weight: bold;">服务费用详情</td>
            </tr>
            <tr>
                <td>服务师傅</td>
                <td>服务费用</td>
                <td>支付时间</td>
                <td>费用类型</td>
            </tr>
            @foreach($paymentOrders as $paymentOrder)
                <tr>
                    <td>{{$paymentOrder->masterName}}</td>
                    <td>{{$paymentOrder->serviceAmount}}</td>
                    <td>{{$paymentOrder->paidDate}}</td>
                    <td>{{$paymentOrder->feeType}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <table class="table table-bordered">
            <tbody>
            <tr>
                <td colspan="6" style="font-size: medium; font-weight: bold;">退款信息</td>
            </tr>
            <tr>
                <td>服务师傅</td>
                <td>退款金额</td>
                <td>申请时间</td>
                <td>退款日期</td>
                <td>服务状态</td>
                <td>说明</td>
            </tr>
            @foreach($order->refundOrders as $item)
                <tr>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
<style>
    .table-bordered{
        margin-bottom: 32px !important;
    }
</style>
