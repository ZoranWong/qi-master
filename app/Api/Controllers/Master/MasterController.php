<?php

namespace App\Api\Controllers\Master;

use App\Api\Controller;
use App\Transformers\MasterTransformer;

class MasterController extends Controller
{
    public function profile()
    {
        $user = auth()->user();

        return $this->response->item($user, new MasterTransformer);
    }
}
