<?php

namespace App\Form\Field;

use Encore\Admin\Admin;
use Encore\Admin\Form\NestedForm;

class Table extends \Encore\Admin\Form\Field\Table
{
    protected $columnAlias;

    protected $viewMode = 'customizeTable';

    public function __construct($column, $arguments = [])
    {
        $this->views['customizeTable'] = 'form.hasmanytable';

        $this->columnAlias = $column;

        parent::__construct($column, $arguments);
    }

    public function setColumnAlias(string $columnAlias)
    {
        $this->columnAlias = $columnAlias;
    }

    public function setupScriptForCustomizeTableView($templateScript)
    {
        $removeClass = NestedForm::REMOVE_FLAG_CLASS;
        $defaultKey = 'new_\d+';

        /**
         * When add a new sub form, replace all element key in new sub form.
         *
         * @example comments[new___key__][title]  => comments[new_{index}][title]
         *
         * {count} is increment number of current sub form count.
         */
        $script = <<<EOT
var index = 0;
$(document).on('click', '#has-many-{$this->column} .add-option', function () {
    var tpl = $('template.{$this->column}-tpl');

    index++;

    var template = tpl.html().replace(/{$defaultKey}/g, index);
    console.log(template);
    $(this).closest('#has-many-{$this->column}').find('tbody').append(template);
//    $('.has-many-{$this->column}-forms').append(template);
    {$templateScript}
});

$(document).on('click', '#has-many-{$this->column} .remove-option', function () {
    console.log('当前按钮选择器：','#has-many-{$this->column}');
    console.log('当前选择器：','.has-many-{$this->column}-form');
    $(this).closest('.has-many-{$this->column}-form').hide();
    $(this).closest('.has-many-{$this->column}-form').find('.$removeClass').val(1);
});
EOT;

        Admin::script($script);
    }

    public function getElementName()
    {
        return $this->elementName;
    }
}
