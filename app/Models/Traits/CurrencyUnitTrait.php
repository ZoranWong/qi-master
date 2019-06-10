<?php
/**
 * Created by PhpStorm.
 * User: wangzaron
 * Date: 2019/6/10
 * Time: 2:43 PM
 */

namespace App\Models\Traits;


trait CurrencyUnitTrait
{
    protected $currencyIcon = '¥';

    protected $currencyColumns = [];

    public function setAttribute($key, $value)
    {
        if (array_search($key, $this->currencyColumns)) {
            $value *= CURRENCY_UNIT_CONVERT_NUM;
        }
        parent::setAttribute($key, $value);
    }

    public function getAttribute($key)
    {
        $value = parent::getAttribute($key);
        if(array_search($key, $this->currencyColumns)){
            $value /= CURRENCY_UNIT_CONVERT_NUM;
        }
        return $value;
    }
}
