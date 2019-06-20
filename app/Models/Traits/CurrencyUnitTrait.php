<?php
/**
 * Created by PhpStorm.
 * User: wangzaron
 * Date: 2019/6/10
 * Time: 2:43 PM
 */

namespace App\Models\Traits;


use Illuminate\Support\Str;

trait CurrencyUnitTrait
{
    protected $currencyIcon = '¥';

    protected $currencyColumns = [];

    public function setAttribute($key, $value)
    {
        if (in_array($key, $this->currencyColumns) && !$this->hasSetMutator($key)) {
            $value *= CURRENCY_UNIT_CONVERT_NUM;
        }
        parent::setAttribute($key, $value);
    }

    public function getAttribute($key)
    {
        $value = parent::getAttribute($key);
        if (array_search($key, $this->currencyColumns) && !$this->hasGetMutator($key)) {
            $value /= CURRENCY_UNIT_CONVERT_NUM;
        }
        return $value;
    }


    protected function accessors()
    {
        foreach ($this->currencyColumns as $column) {
            $key = Str::studly($column);
            $accessor = "set{$key}Attribute";
            $this->{$accessor} = function ($value) use ($key) {
                $this->attributes[$key] = $value * 100;
            };
        }
    }

    protected function mutators()
    {
        foreach ($this->currencyColumns as $column) {
            $key = Str::studly($column);
            $mutator = "get{$key}Attribute";
            $this->{$mutator} = function () use ($key) {
                return $this->attributes[$key] / 1000;
            };
        }
    }

    protected function accessorAndMutator()
    {
        // TODO: Implement __invoke() method.
//        $this->accessors();
//        $this->mutators();
    }
}
