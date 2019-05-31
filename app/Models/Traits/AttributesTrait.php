<?php
/**
 * Created by PhpStorm.
 * User: wangzaron
 * Date: 2019/5/31
 * Time: 11:18 AM
 */

namespace App\Models\Traits;


trait AttributesTrait
{
    public function __get($name)
    {
        $key = camelCaseToUnderScoreCase($name);
        // TODO: Implement __get() method.
        return $this->getAttribute($key);
    }

    public function __set($name, $value)
    {
        // TODO: Implement __set() method.
        $key = camelCaseToUnderScoreCase($name);
        $this->setAttribute($key, $value);
    }
}
