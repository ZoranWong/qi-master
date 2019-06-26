<?php

namespace App\Repositories;

use App\Models\Order;
use Prettus\Repository\Contracts\RepositoryInterface;

interface OrderRepository extends RepositoryInterface
{
    public function getOfferOrderList(Order $order);

    public function getList();
}
