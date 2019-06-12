<?php


namespace App\Form\Field;

use Encore\Admin\Admin;
use Encore\Admin\Form\NestedForm;

class HasMany extends \Encore\Admin\Form\Field\HasMany
{
    protected $viewMode = 'customizeHasMany';

    public function __construct($relationName, $arguments = [])
    {
        $this->views['customizeHasMany'] = 'form.hasmany';

        parent::__construct($relationName, $arguments);
    }

    /**
     * 自选择视图模式
     * @param string $viewMode 视图选择
     * @return HasMany
     */
    public function setViewMode(string $viewMode)
    {
        $this->viewMode = $viewMode;

        return $this;
    }

    /**
     * Setup default template script.
     *
     * @param string $templateScript
     *
     * @return void
     */
    protected function setupScriptForCustomizeHasManyView($templateScript)
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
$('#has-many-{$this->column}').off('click', '.add').on('click', '.add', function () {

    var tpl = $('template.{$this->column}-tpl');
    index++;

    var template = tpl.html().replace(/{$defaultKey}/g, index);
    $('.has-many-{$this->column}-forms').append(template);
    {$templateScript}
});

$('#has-many-{$this->column}').off('click', '.edit').on('click', '.edit', function () {
    var tpl = $('template.{$this->column}-edit-tpl');
    console.log(tpl);
});

$('#has-many-{$this->column}').off('click', '.remove').on('click', '.remove', function () {
    $(this).closest('.has-many-{$this->column}-form').hide();
    $(this).closest('.has-many-{$this->column}-form').find('.$removeClass').val(1);
});

EOT;

        Admin::script($script);
    }
}
