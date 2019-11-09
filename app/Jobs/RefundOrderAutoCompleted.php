<?php

namespace App\Jobs;

use App\Models\RefundOrder;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class RefundOrderAutoCompleted implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var RefundOrder $refund
     * */
    protected $refund = null;

    /**
     * Create a new job instance.
     *
     * @param RefundOrder $refund
     */
    public function __construct(RefundOrder $refund)
    {
        //
        $this->refund = $refund;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        if($this->refund->status === RefundOrder::APPLY_STATUS_WAIT){
            $this->refund->status = RefundOrder::APPLY_STATUS_DONE;
            $this->refund->user->balance += $this->refund->amount;
            $this->refund->user->save();
            $this->refund->save();
            // 您的订单(${orderNo})已成功退款，退款金额：${fee}元(其中${balanceFee}元退回钱包，${couponFee}元退回现金券账户，${marginFee}元退回服务保障金)。
            app('sms')->sendSms($this->refund->user->mobile, 'refunded_success', [
                'orderNo' => $this->refund->order->orderNo,
                'fee' => $this->refund->amount,
                'balanceFee' => $this->refund->amount,
                'couponFee' => 0,
                'marginFee' => 0
            ]);
        }
    }
}
