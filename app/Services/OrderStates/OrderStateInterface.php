<?php
/**
 * Created by PhpStorm.
 * User: wangzaron
 * Date: 2019/5/31
 * Time: 1:45 PM
 */

namespace App\Services\OrderStates;


interface OrderStateInterface
{
    function paying();
    function paid();
    function cancel();
    function completed();
    function refunding();
    function refunded();
}
