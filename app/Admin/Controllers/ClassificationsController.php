<?php


namespace App\Admin\Controllers;


use App\Http\Controllers\Controller;
use App\Models\Classification;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class ClassificationsController extends Controller
{
    use HasResourceActions;

    public function index(Content $content)
    {
        return $content->header('类目列表')
            ->body($this->grid());
    }

    public function create(Content $content)
    {
        return $content->header(trans('admin.classifications'))->description(trans('admin.create'))
            ->body($this->form());
    }

    public function edit(Content $content, Classification $classification)
    {
        return $content->header(trans('admin.classifications'))->description(trans('admin.edit'))
            ->body($this->form()->edit($classification->id));
    }

    public function show(Content $content, Classification $classification)
    {
        return $content->header(trans('admin.classifications'))->description(trans('admin.detail'))
            ->body($this->detail($classification));
    }

    public function detail(Classification $classification)
    {
        $show = new Show($classification);

        $show->field('id', 'ID');

        $show->field('name', trans('admin.name'));

        $show->field('icon_url', '图标')->image();

        return $show;
    }

    public function form()
    {
        $form = new Form(new Classification);

        $form->display('id', 'ID');

        $form->text('name', trans('admin.name'))->rules('required');

        $form->image('icon_url', trans('admin.icon'))->default('')->rules('required');

        $form->number('sort', '排序');

        $form->radio('is_hot', '是否热门')->options([0 => '否', 1 => '是'])->default(0);

        $form->radio('is_new', '是否新服务')->options([0 => '否', 1 => '是'])->default(0);

        $form->radio('status', '是否开启')->options([0 => '否', 1 => '是'])->default(0);

        return $form;
    }

    public function grid()
    {
        $grid = new Grid(new Classification);

        $grid->column('id', 'ID')->sortable();

        $grid->column('name', '类目名称');

        $grid->column('icon_url', '图标')->display(function ($iconUrl) {
            return "<img width='40px' src='{$iconUrl}' />";
        });

        $grid->column('is_hot', '是否热门')->display(function ($isHot) {
            return $isHot ? '是' : '否';
        });

        $grid->column('is_new', '是否新服务')->display(function ($isNew) {
            return $isNew ? '是' : '否';
        });

        $grid->column('sort', '排序');

        $grid->column('status', '状态')->display(function ($status) {
            return Classification::STATUS[$status];
        });

        return $grid;
    }
}
