<?php


namespace App\Form\Field;

use App\Models\Traits\HasManyExtendTrait;
use Encore\Admin\Admin;

class HasMany extends \Encore\Admin\Form\Field\HasMany
{
    use HasManyExtendTrait;

    protected $viewMode = 'customizeHasMany';

    public function __construct($relationName, $arguments = [])
    {
        $this->views['customizeHasMany'] = 'form.hasmany';

        parent::__construct($relationName, $arguments);
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
        $defaultKey = 'new_\d+';

        /**
         * When add a new sub form, replace all element key in new sub form.
         *
         * @example comments[new___key__][title]  => comments[new_{index}][title]
         *
         * {count} is increment number of current sub form count.
         */
        $script = <<<EOT
var propertiesCount = 0;
$(document).off('click', '#has-many-{$this->column} .add').on('click', '#has-many-{$this->column} .add', function () {

    var tpl = $('template.{$this->column}-tpl');
    propertiesCount++;

    var template = tpl.html().replace(/{$defaultKey}/g, index);
    template = $(template);
    template.find('table').attr('data-index', propertiesCount);
    $('.has-many-{$this->column}-forms').append(template);
    {$templateScript}
});

$(document).off('click', '#has-many-{$this->column} .edit').on('click', '#has-many-{$this->column} .edit', function () {
    var tpl = $('template.{$this->column}-edit-tpl');
    console.log(tpl);
});

$(document).off('click', '#has-many-{$this->column} .remove').on('click', '#has-many-{$this->column} .remove', function () {
    console.log('当前按钮选择器2：','#has-many-{$this->column}');
    console.log('当前选择器2：','.has-many-{$this->column}-form');
    $(this).closest('.has-many-{$this->column}-form').hide();
    $(this).closest('.has-many-{$this->column}-form').find('.$removeClass').val(1);
});

EOT;

        Admin::script($script);
    }

    /**
     * Build a Nested form.
     *
     * @param string $column
     * @param \Closure $builder
     * @param null $model
     *
     * @return NestedForm
     */
    protected function buildNestedForm($column, \Closure $builder, $model = null)
    {
//        $form = new NestedForm($column, $model);

        /** @var \Encore\Admin\Form\NestedForm $form */
        $form = new $this->nestedTableClass($column, $model);

        $form->setForm($this->form);

        call_user_func($builder, $form);

        $form->hidden($this->getKeyName());

        $form->hidden(NestedForm::REMOVE_FLAG_NAME)->default(0)->addElementClass(NestedForm::REMOVE_FLAG_CLASS);

        return $form;
    }
}
