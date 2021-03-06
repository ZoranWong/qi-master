<?php

namespace App\Listeners;

use App\Events\SendOrderSmsEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendOrderSmsListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  SendOrderSmsEvent  $event
     * @return void
     */
    public function handle(SendOrderSmsEvent $event)
    {
        //
        app('sms')->sendSms($event->order->user->mobile, 'SMS_175531882', []);
    }
}
