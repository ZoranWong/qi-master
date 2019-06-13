<?php

namespace App\Admin\Controllers;

use App\Form\Field\NestedForm;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Classification;
use App\Models\ServiceType;
use Encore\Admin\Admin;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class CategoriesController extends Controller
{
    use HasResourceActions;

    public function index(Content $content)
    {
        return $content->header(trans('admin.categories'))->description(trans('admin.list'))
            ->body($this->grid());
    }

    public function create(Content $content)
    {
        return $content->header(trans('admin.categories'))->description(trans('admin.create'))
            ->body($this->form());
    }

    public function show(Content $content, Category $category)
    {
        return $content->header(trans('admin.categories'))->description(trans('admin.detail'))
            ->body($this->detail($category));
    }

    public function edit(Content $content, Category $category)
    {
        return $content->header(trans('admin.categories'))->description(trans('admin.edit'))
            ->body($this->form()->edit($category->getKey()));
    }

    protected function detail(Category $category)
    {
        $show = new Show($category);

        $show->field('id', 'ID');

        $show->classification('所属类目', function (Show $classification) {
            $classification->setResource('/admin/classifications');
            $classification->field('id', 'ID');
            $classification->field('name', trans('admin.classifications'));
            $classification->field('icon_url', trans('admin.icon'))->image();
        });

        $show->parent('父级类别', function (Show $category) {
            $category->setResource('/admin/categories');
            $category->field('id', 'ID');
            $category->field('name', trans('admin.name'));
        });

        $show->field('unit', trans('admin.unit'));

        $show->field('price', trans('admin.price'));

        return $show;
    }

    protected function grid()
    {
        $grid = new Grid(new Category);

        $grid->column('id', 'ID')->sortable();

        $grid->column('name', trans('admin.name'));

        $grid->column('classification.name', '所属类目');

        $grid->column('parent.name', '父级类别')->display(function ($parentName) {
            return is_null($parentName) ? 'Root' : $parentName;
        });

        $grid->column('unit', trans('admin.unit'));

        $grid->column('price', trans('admin.price'))->display(function ($price) {
            return '￥' . number_format($price, 2);
        });

        $grid->column('sort', trans('admin.sort'));

        Admin::css('.grid-action {padding-right: 3px;}');

        return $grid;
    }

    public function form()
    {
        $form = $this->basicForm();

        $form
            ->tab('类别商品属性', function (Form $form) {
                $form->customizeHasMany('properties', '商品属性', function (NestedForm $form) {
                    $form->text('title', '属性名称')->rules('required');
                    $form->customizeTable('value', '属性值(多项)', function (NestedForm $nestedForm) use ($form) {
                        $nestedForm->setRelationName(function (&$relationName) {
                            $relationName = "[{$relationName}]";
                        });
                        $nestedForm->setElementNameExtendCallback(function (&$elementName) use ($form) {
                            $relationName = $form->getRelationName();
                            $key = $form->getKey();
                            $elementName = "{$relationName}[{$key}]$elementName";
                        });
                        $nestedForm->text('title', '属性小名称')->rules('required');
                        $nestedForm->currency('price', '价格')->symbol('￥')->rules('required');
                    })->setSlug('properties');
                });
            })
            ->tab('类别专属服务要求', function (Form $form) {
                $form->customizeHasMany('requirements', '服务类型要求', function (NestedForm $form) {
                    $serviceTypes = ServiceType::all()->pluck('name', 'id');
                    $form->select('service_id', '服务类型')->options($serviceTypes);
                    $form->text('name', '要求名称')->rules('required');
                    $form->customizeTable('value', '要求项(多项)', function (NestedForm $nestedForm) use ($form) {
                        $nestedForm->setRelationName(function (&$relationName) {
                            $relationName = "[{$relationName}]";
                        });
                        $nestedForm->setElementNameExtendCallback(function (&$elementName) use ($form) {
                            $relationName = $form->getRelationName();
                            $key = $form->getKey();
                            $elementName = "{$relationName}[{$key}]$elementName";
                        });
                        // 所有的服务类型
                        $nestedForm->text('title', '要求小项')->rules('required');
                        $nestedForm->currency('price', '价格')->symbol('￥')->rules('required');
                    })->setSlug('requirements');
                });
            });

        $form->saving(function ($form) {
            dd($form);
        });

        return $form;
    }

    protected function basicForm()
    {
        $form = new Form(new Category);

        $form->tab('基础信息', function (Form $form) {
            $form->display('id', 'ID');
            $classifications = Classification::all()->pluck('name', 'id');
            $form->select('classification_id', '所属类目')->options($classifications);
            $categories = Category::selectOptions();
            $form->select('parent_id', '父分类')->options($categories);
            $form->text('name', trans('admin.name'));
            $form->text('unit', '单位')->default('')->placeholder('输入 单位 如套，个，件，箱...');
            $form->currency('price', '报价')->symbol('¥');
            $form->number('sort', '排序');
        });

        return $form;
    }

    protected function propertyForm()
    {
        $form = $this->basicForm();

        $form->tab('附加属性', function (Form $form) {
            $form->hasMany('properties', '类别商品属性', function (Form\NestedForm $form) {
                $form->text('title');
                $form->table('value', '具体属性', function ($table) {
                    $table->text('title');
                    $table->currency('price')->symbol('￥');
                });
            })->default([]);
        });

        $form->saving(function (Form $form) {
            dd($form);
        });

        return $form;
    }
}
