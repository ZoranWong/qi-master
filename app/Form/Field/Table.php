<?php

namespace App\Form\Field;

use App\Models\Traits\HasManyExtendTrait;
use Encore\Admin\Admin;

class Table extends \Encore\Admin\Form\Field\Table
{
    use HasManyExtendTrait;

    protected $viewMode = 'customizeTable';

    protected $slug = 'default';

    protected $defaultKeyName;

    public function __construct($column, $arguments = [])
    {
        $this->views['customizeTable'] = 'form.hasmanytable';

        parent::__construct($column, $arguments);
    }

    public function setSlug(string $slug)
    {
        $this->slug = $slug;

        return $this;
    }

    public function setDefaultKeyName(string $defaultKeyName)
    {
        $this->defaultKeyName = $defaultKeyName;

        return $this;
    }

    public function setupScriptForCustomizeTableView($templateScript)
    {
        $removeClass = NestedForm::REMOVE_FLAG_CLASS;
//        $defaultKey = NestedForm::DEFAULT_KEY_NAME;
        $defaultKey = $this->defaultKeyName;


        /**
         * When add a new sub form, replace all element key in new sub form.
         *
         * @example comments[new___key__][title]  => comments[new_{index}][title]
         *
         * {count} is increment number of current sub form count.
         */
        $script = <<<EOT

$(document).on('click', '.has-many-{$this->column}-{$this->slug} .add-option', function () {
    
    var tpl = $('template.{$this->column}-{$this->slug}-tpl');
    console.log('template name: ',"{$this->column}-{$this->slug}-tpl","{$defaultKey}");
    
    var tbodyEle = $(this).closest('.has-many-{$this->column}-{$this->slug}').find('tbody');
    
    var template = tpl.html().replace(/new_{$defaultKey}/g, tbodyEle.find('tr').length);
    
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

    /**
     * Render the `HasMany` field for table style.
     *
     * @return mixed
     * @throws \Exception
     *
     */
    protected function renderTable()
    {
        return parent::renderTable()->with(['slug' => $this->slug]);
    }
}
