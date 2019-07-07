<?php

namespace App\Admin\Controllers;

use App\Form\Field\NestedForm;
use App\Http\Controllers\Controller;
use App\Http\Requests\Request;
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
            return is_null($parentName) ? '<span style="font-weight: bold;color: #249c0d;">【顶级类别】</span>' : $parentName;
        });

        $grid->column('unit', trans('admin.unit'));

        $grid->column('price', '基础价格')->display(function ($price) {
            return '￥' . number_format($price, 2);
        });

        $grid->column('sort', trans('admin.sort'));

        $grid->actions(function (Grid\Displayers\Actions $actions) {
            $actions->disableView();
        });

        Admin::css('.grid-action {padding-right: 3px;}');

        return $grid;
    }

    public function form()
    {
        $form = $this->basicForm();

        $form->tab('类别商品属性', function (Form $form) {
                $form->customizeHasMany('properties', '商品属性', function (NestedForm $form) {
                    static $key;
                    $form->setKey($key);
                    $key ++;
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
                        $nestedForm->setDefaultKeyNameRerenderCallback("__PROPERTIES__");
                        $nestedForm->text('title', '属性小名称');
                        $nestedForm->currency('price', '价格')
                            ->symbol('￥');
                    })->setSlug('properties')->setDefaultKeyName('__PROPERTIES__');
                })->setSlug('properties');
            })->tab('类别专属服务要求', function (Form $form) {
                $form->customizeHasMany('requirements', '服务类型要求', function (NestedForm $form) {
                    static $key;
                    $form->setKey($key);
                    $key ++;
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
                        $nestedForm->setDefaultKeyNameRerenderCallback('__REQUIREMENTS__');
                        // 所有的服务类型
                        $nestedForm->text('title', '要求小项');
                        $nestedForm->currency('price', '价格')->default(0)->symbol('￥');
                    })->setSlug('requirements')->setDefaultKeyName('__REQUIREMENTS__');
                })->setSlug('requirements');
            })->tab('类别规格需求', function (Form $form) {
                $form->customizeHasMany('measurements', '规格需求', function (NestedForm $form) {
                    static $key;
                    $form->setKey($key);
                    $key++;
                    $form->text('name', '规格名称')->placeholder("名称：如长、宽、高、重量、体积等");
                    $form->text('unit', '规格单位')->placeholder("单位:如cm、kg、g、立方厘米等");
                })->setSlug('measurements');
            });

        $form->saving(function (Form $form) {
            $properties = $form->input('properties');
            if (!is_null($properties)) {
                foreach ($properties as &$property) {
                    $property['value'] = array_values($property['value']);
                }
                $form->input('properties', $properties);
            }

            $requirements = $form->input('requirements');
            if (!is_null($requirements)) {
                foreach ($requirements as &$requirement) {
                    $requirement['value'] = array_values($requirement['value']);
                }
                $form->input('requirements', $requirements);
            }
        });

        return $form;
    }

    protected function basicForm()
    {
        $form = new Form(new Category);

        $form->tab('基础信息', function (Form $form) {
            $form->display('id', 'ID');
            $classifications = Classification::all()->pluck('name', 'id');
            $form->select('classification_id', '所属类目')
                ->options($classifications)->required();
            $categories = Category::selectOptions();
            $form->select('parent_id', '父分类')
                ->options($categories);
            $form->text('name', trans('admin.name'));
            $form->text('unit', '单位')->default('')
                ->placeholder('输入 单位 如套，个，件，箱...');
            $form->currency('price', '报价')->symbol('¥');
            $form->number('sort', '排序')->default(0)
                ->rules('required|numeric');
        });

        return $form;
    }

    public function topCategories()
    {
        $classificationId = \Illuminate\Support\Facades\Request::input('q');
        $categories = Category::where('classification_id', $classificationId)
            ->where('parent_id', 0)->get(['id', 'name as text']);
        return response()->json($categories);
    }

    public function childCategories()
    {
        $id = \Illuminate\Support\Facades\Request::input('q');
        $categories = Category::where('parent_id', $id)->get(['id', 'name as text']);
        return response()->json($categories);
    }
}
