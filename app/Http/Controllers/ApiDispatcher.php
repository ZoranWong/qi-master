<?php
/**
 * Created by PhpStorm.
 * User: wangzaron
 * Date: 2019/6/24
 * Time: 5:06 PM
 */

namespace App\Http\Controllers;


use Dingo\Api\Dispatcher;
use Tymon\JWTAuth\Facades\JWTAuth;

trait ApiDispatcher
{
    protected function dispatcher(bool $auth = true)
    {
        /**@var Dispatcher $dispatcher**/
        $dispatcher = $this->api;
        if($auth){
            $token = JWTAuth::fromUser(auth()->user());
            $dispatcher = $dispatcher->header('Authorization', "bearer {$token}");
        }
        return $dispatcher;
    }
}
