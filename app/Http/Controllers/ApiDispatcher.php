<?php
/**
 * Created by PhpStorm.
 * User: wangzaron
 * Date: 2019/6/24
 * Time: 5:06 PM
 */

namespace App\Http\Controllers;


use Dingo\Api\Dispatcher;

trait ApiDispatcher
{
    protected function dispatcher(bool $auth = true)
    {
        /**@var Dispatcher $dispatcher**/
        $dispatcher = $this->api;
        if($auth){
            $token = session('token');
            $dispatcher = $dispatcher->header('Authorization', "bearer {$token}");
        }
        return $dispatcher;
    }
}
