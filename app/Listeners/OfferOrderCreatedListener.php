<?php

namespace App\Listeners;

use App\Events\OfferOrderCreated;
use App\Models\Order;

class OfferOrderCreatedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param OfferOrderCreated $offerOrderCreated
     * @return void
     */
    public function handle(OfferOrderCreated $offerOrderCreated)
    {
        $offerOrder = $offerOrderCreated->getOfferOrder();

        $order = $offerOrder->order;

        if ($order->status === Order::ORDER_WAIT_OFFER) {
            $order->update(['status' => Order::ORDER_WAIT_HIRE]);
        }
    }
}
