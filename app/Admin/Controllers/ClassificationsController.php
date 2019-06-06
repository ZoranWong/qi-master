<?php


namespace App\Admin\Controllers;


use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Layout\Content;

class ClassificationsController extends Controller
{
    use HasResourceActions;

    public function index(Content $content)
    {
        return $content->header('类目列表')
            ->body(view('admin.classification.index'));
    }
}
