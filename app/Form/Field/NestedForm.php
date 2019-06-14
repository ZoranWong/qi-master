<?php

namespace App\Form\Field;

use Encore\Admin\Form\Field;

class NestedForm extends \Encore\Admin\Form\NestedForm
{
    protected $elementNameExtendCallback;

    protected $relationNameExtendCallback;

    protected $defaultKeyNameRerenderCallback;

    const DEFAULT_KEY_NAME_PREFIX = 'new_';

    /**
     * 解决冲突，如class attribute中[]符号的问题
     * @var string $extendRelationName 扩展后的关联名
     */
    protected $extendRelationName;

    public function setElementNameExtendCallback(callable $callback)
    {
        $this->elementNameExtendCallback = $callback;
    }

    public function getRelationName()
    {
        return $this->relationName;
    }

    public function setRelationName($relationName)
    {
        $this->extendRelationName = is_callable($relationName) ? tap($this->relationName, $relationName) : $relationName;
    }

    /**
     * Set `errorKey` `elementName` `elementClass` for fields inside hasmany fields.
     *
     * @param Field $field
     *
     * @return Field
     */
    protected function formatField(Field $field)
    {
        $column = $field->column();

        $elementName = $elementClass = $errorKey = [];

        $key = $this->getKey();

        if (is_array($column)) {
            foreach ($column as $k => $name) {
                $errorKey[$k] = sprintf('%s.%s.%s', $this->relationName, $key, $name);
                if ($this->extendRelationName) {
                    $elementName[$k] = sprintf('%s[%s][%s]', $this->extendRelationName, $key, $name);
                } else {
                    $elementName[$k] = sprintf('%s[%s][%s]', $this->relationName, $key, $name);
                }
                $elementClass[$k] = [$this->relationName, $name];
            }
        } else {
            $errorKey = sprintf('%s.%s.%s', $this->relationName, $key, $column);
            if ($this->extendRelationName) {
                $elementName = sprintf('%s[%s][%s]', $this->extendRelationName, $key, $column);
            } else {
                $elementName = sprintf('%s[%s][%s]', $this->relationName, $key, $column);
            }
            $elementClass = [$this->relationName, $column];
        }

        if ($this->elementNameExtendCallback) {
            $elementName = tap($elementName, $this->elementNameExtendCallback);
        }

        return $field->setErrorKey($errorKey)
            ->setElementName($elementName)
            ->setElementClass($elementClass);
    }

    /**
     * Get the value of the model's primary key.
     *
     * @return mixed|null
     */
    public function getKey()
    {
//        if ($this->model) {
//            $key = $this->model->getKey();
//        }

        if (!is_null($this->key)) {
            $key = $this->key;
        }

        if (isset($key)) {
            return $key;
        }

        $defaultKeyName = static::DEFAULT_KEY_NAME;
        if ($this->defaultKeyNameRerenderCallback) {
            if (is_callable($this->defaultKeyNameRerenderCallback)) {
                $defaultKeyName = tap($defaultKeyName, $this->defaultKeyNameRerenderCallback);
            } else {
                $defaultKeyName = $this->defaultKeyNameRerenderCallback;
            }
        }

        return static::DEFAULT_KEY_NAME_PREFIX . $defaultKeyName;
    }

    public function setDefaultKeyNameRerenderCallback($callback)
    {
        $this->defaultKeyNameRerenderCallback = $callback;
    }
}
