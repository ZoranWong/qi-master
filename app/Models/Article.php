<?php

namespace App\Models;

use App\Models\Traits\ModelAttributesAccess;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //
    use ModelAttributesAccess;

    protected $fillable = ['title', 'cover_url', 'content', 'sort', 'publish_at'];
}
