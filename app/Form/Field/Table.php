<?php

namespace App\Form\Field;

use App\Models\Traits\HasManyExtendTrait;
use Encore\Admin\Admin;

class Table extends \Encore\Admin\Form\Field\Table
{
    use HasManyExtendTrait;

    protected $viewMode = 'customizeTable';

    public function __construct($column, $arguments = [])
    {
        $this->views['customizeTable'] = 'form.hasmanytable';

        parent::__construct($column, $arguments);
    }

    public function setupScriptForCustomizeTableView($templateScript)
    {
        $removeClass = NestedForm::REMOVE_FLAG_CLASS;
        $defaultKey = NestedForm::DEFAULT_KEY_NAME;

        /**
         * When add a new sub form, replace all element key in new sub form.
         *
         * @example comments[new___key__][title]  => comments[new_{index}][title]
         *
         * {count} is increment number of current sub form count.
         */
        $script = <<<EOT
var index = 0;

$(document).on('click', '.has-many-{$this->column} .add-option', function () {
    var tpl = $('template.{$this->column}-tpl');
    
    index++;
    
    var template = tpl.html().replace(/{$defaultKey}/g, index);
    
    var tbodyEle = $(this).closest('.has-many-{$this->column}').find('tbody');
    
    tbodyEle.append(template);
    
    var dataIndex = tbodyEle.parent('table').attr('data-index');
    
    var fieldElements = tbodyEle.children("tr:last-child").find('.{$this->column}');
    fieldElements.each(function(){
        var name = $(this).attr('name');
        $(this).attr('name',name.replace(/\[\d+\]/,'['+dataIndex+']'));
    });
    
    {$templateScript}
});

$(document).on('click', '.has-many-{$this->column} .remove-option', function () {
    console.log('当前按钮选择器：','#has-many-{$this->column}');
    console.log('当前选择器：','.has-many-{$this->column}-form');
    $(this).closest('.has-many-{$this->column}-form').hide();
    $(this).closest('.has-many-{$this->column}-form').find('.$removeClass').val(1);
});

EOT;

        Admin::script($script);
    }

    protected function buildNestedForm($column, \Closure $builder, $key = null)
    {
        /** @var \Encore\Admin\Form\NestedForm $form */
        $form = new $this->nestedTableClass($column);

        $form->setForm($this->form)
            ->setKey($key);

        call_user_func($builder, $form);

        $form->hidden(NestedForm::REMOVE_FLAG_NAME)->default(0)->addElementClass(NestedForm::REMOVE_FLAG_CLASS);

        return $form;
    }
}
