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
$('#has-many-{$this->column}').on('click', '.add', function () {

    var tpl = $('template.{$this->column}-tpl');

    index++;

    var template = tpl.html().replace(/{$defaultKey}/g, index);
    $('.has-many-{$this->column}-forms').append(template);
    {$templateScript}
});

$('#has-many-{$this->column}').on('click', '.remove', function () {
    $(this).closest('.has-many-{$this->column}-form').hide();
    $(this).closest('.has-many-{$this->column}-form').find('.$removeClass').val(1);
});

EOT;

        Admin::script($script);
    }

    /**
     * 自选择视图模式
     * @param string $viewMode 视图选择
     * @return Table
     */
    public function setViewMode(string $viewMode)
    {
        $this->viewMode = $viewMode;

        return $this;
    }
}
