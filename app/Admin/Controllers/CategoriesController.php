<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Classification;
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

    public function properties(Content $content, Category $category)
    {
        return $content->header(trans('admin.categories'))->description('附加属性')
            ->body($this->propertyForm()->edit($category->getKey()));
    }

    public function requirements(Content $content, Category $category)
    {
        return $content->header(trans('admin.categories'))->description('服务要求')
            ->body($this->form()->edit($category->getKey()));
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

        $grid->actions(function (Grid\Displayers\Actions $actions) {
            $actions->append("<a href='/admin/categories/{$actions->getKey()}/properties' title='编辑类别商品属性' class='grid-row-view grid-action'><i class='fa fa-edit'></i></a>");
            $actions->append("<a href='/admin/categories/{$actions->getKey()}/requirements' title='编辑服务要求' class='grid-row-view grid-action'><i class='fa fa-edit'></i></a>");
        });

        Admin::style('.grid-action {padding-right: 3px;}');

        return $grid;
    }

    public function form()
    {
        $form = $this->basicForm();

        $form->tab('类别商品属性', function (Form $form) {
            $form->customizeHasMany('properties', '属性', function (Form\NestedForm $form) {
                $form->text('title', '属性名称');
                $form->customizeTable('value', '属性值(多项)', function (Form\NestedForm $form) {
                    $form->text('title', '属性小名称');
//                    $form->text('title')->setElementName("properties[1][value][0][title]");
                    $form->currency('价格')->symbol('￥');
                });
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
