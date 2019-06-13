<?php

namespace App\Models\Traits;

use App\Form\Field\NestedForm;

/**
 * Trait HasManyExtendTrait
 * 对于Encore\Admin\Form\Field\HasMany类的基本扩充
 * @package App\Models\Traits
 */
trait HasManyExtendTrait
{
    private $nestedTableClass = NestedForm::class;

    /**
     * 设置NestedTable的类型，使得该子类仍然适用于原\Encore\Admin\Form\NestedForm类
     * @param string $nestedTableClass
     */
    public function setNestedTable(string $nestedTableClass)
    {
        switch ($nestedTableClass) {
            case NestedForm::class:
                $this->nestedTableClass = NestedForm::class;
                break;
            case \Encore\Admin\Form\NestedForm::class:
                $this->nestedTableClass = \Encore\Admin\Form\NestedForm::class;
            default:
                throw new \InvalidArgumentException('必须为NestedTable类型');
        }
    }
}
