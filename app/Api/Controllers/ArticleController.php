<?php

namespace App\Api\Controllers;

use App\Models\Article;
use App\Transformers\ArticleTransformer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    //

    public function index()
    {
        $articles = Article::orderBy('publish_at', 'desc')->paginate();
        return $this->response->paginator($articles, new ArticleTransformer());
    }
}
