<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Log;

class OrderPolicy
{
    use HandlesAuthorization;

    public function own(User $user, Order $order)
    {

        return $order->userId === $user->id;
    }
}
