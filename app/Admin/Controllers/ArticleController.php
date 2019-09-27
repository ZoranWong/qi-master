<?php

namespace App\Admin\Controllers;

use App\Models\Article;
use Carbon\Carbon;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ArticleController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '文章管理';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Article);
        $grid->column('id', 'ID');
        $grid->column('title', '标题');
        $grid->column('cover_url', '封面')->image('', 64, 64);
        $grid->column('sort', '排序')->sortable();
        $grid->column('publish_at', '发布时间')->sortable();
        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Article::findOrFail($id));
        $show->field('title', '标题');
        $show->field('sort', '排序');
        $show->field('cover_url', '封面')->image();
        $show->field('publish_at', '发布时间');
        $show->field('content', '文章');
        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Article);
        $form->text('title', '标题');
        $form->image('cover_url', '封面');
        $form->number('sort', '排序');
        $form->date('publish_at', '发布时间');
        $form->UEditor('content');
        return $form;
    }
}
