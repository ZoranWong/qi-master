<?php


namespace App\Form\Field;

use App\Models\Traits\HasManyExtendTrait;
use Closure;
use Encore\Admin\Admin;
use Encore\Admin\Form\NestedForm;

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
        $defaultKey = NestedForm::DEFAULT_KEY_NAME;

        $countName = 'propertiesCount' . rand(0, 100);

        /**
         * When add a new sub form, replace all element key in new sub form.
         *
         * @example comments[new___key__][title]  => comments[new_{index}][title]
         *
         * {count} is increment number of current sub form count.
         */
        $script = <<<EOT
        
var {$countName} = $(".has-many-{$this->column}-form").length;//初始化节点数目

$(".has-many-{$this->column}-form").each(function(index) {
    $(this).find('table').attr('data-index',index+1);
});

$(document).off('click', '#has-many-{$this->column} .add').on('click', '#has-many-{$this->column} .add', function () {

    var tpl = $('template.{$this->column}-tpl');
    {$countName}++;
    console.log('propertiesCount:',{$countName});

//    var template = tpl.html().replace(/{$defaultKey}/g, {$countName});
    var template = tpl.html().replace(/new_{$defaultKey}/g, {$countName});
    template = $(template);
    template.find('table').attr('data-index', {$countName});
    $('.has-many-{$this->column}-forms').append(template);
    {$templateScript}
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
     * @param Closure $builder
     * @param null $model
     *
     * @return NestedForm
     */
    protected function buildNestedForm($column, Closure $builder, $model = null)
    {
        /** @var NestedForm $form */
        $form = new $this->nestedTableClass($column, $model);

        $form->setForm($this->form);

        call_user_func($builder, $form);

        $form->hidden($this->getKeyName());

        $form->hidden(NestedForm::REMOVE_FLAG_NAME)->default(0)->addElementClass(NestedForm::REMOVE_FLAG_CLASS);

        return $form;
    }
}
