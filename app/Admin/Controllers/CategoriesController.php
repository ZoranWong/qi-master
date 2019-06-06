<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Classification;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;

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

    public function edit(Content $content, Category $category)
    {
        return $content->header(trans('admin.categories'))->description(trans('admin.edit'))
            ->body($this->form()->edit($category->id));
    }

    public function grid()
    {
        $grid = new Grid(new Category);

        $grid->column('id', 'ID')->sortable();

        $grid->column('name', trans('admin.name'));

        $grid->column('classification.name', '所属类目');

        $grid->column('parent.name', '父级类别');

        $grid->column('unit', trans('admin.unit'));

        $grid->column('price', trans('admin.price'))->display(function ($price) {
            return '￥' . number_format($price / 100, 2);
        });

        $grid->column('sort', trans('admin.sort'));

        return $grid;
    }

    public function form()
    {
        $form = new Form(new Category);

        $form->display('id', 'ID');

        $form->text('name', trans('admin.name'));

        $classifications = Classification::all()->pluck('name', 'id');
        $form->multipleSelect('classification_id', '所属类目')->options($classifications);

        return $form;
    }
}
