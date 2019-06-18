<?php

namespace App\Admin\Controllers;

use App\Models\Classification;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Illuminate\Support\Facades\Request;

class ProductsController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('商品列表')
            ->body($this->grid());
    }

    /**
     * Edit interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header('编辑商品')
            ->body($this->form()->edit($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header('创建商品')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Product);

        $grid->id('ID')->sortable();
        $grid->title('商品名称');
        $grid->column('image', '商品图片')->image();
        $grid->column('classification', '类目')->display(function () {
            /**@var Product $product * */
            $product = $this;
            $classification = $product->classification;
            return $classification ? $classification['name'] : '';
        });
        $grid->column('category', '类别')->display(function () {
            /**@var Product $product * */
            $product = $this;
            $category = $product->category;
            $childCategory = $product->childCategory;
            $category = $category ? $category['name'] : '';
            return $childCategory ? ($category . '-' . $childCategory['name']) : $category;
        });
        $grid->disableActions();
        $grid->tools(function ($tools) {
            // 禁用批量删除按钮
            $tools->batch(function ($batch) {
                $batch->disableDelete();
            });
        });

        return $grid;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Product);

        $classifications = Classification::where('status', Classification::STATUS_ON)->get();
        $classifications = $classifications->pluck ('name', 'id');
        $form->select('classification_id', '类目')->options($classifications)->load('category_id', route('admin.categories.top'))->required();
        $form->select('category_id', '类型')->load('child_category_id', route('admin.categories.children'))->required();
        $form->select('child_category_id', '子类型')->default(0);
        // 创建一个输入框，第一个参数 title 是模型的字段名，第二个参数是该字段描述
        $form->text('title', '商品名称')->rules('required');

        // 创建一个选择图片的框
        $form->image('image', '封面图片')->rules('required|image');

        return $form;
    }
}
