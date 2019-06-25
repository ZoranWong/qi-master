<?php

namespace App\Api\Controllers\Master;

use App\Api\Controller;
use App\Repositories\MasterRepository;
use App\Transformers\MasterTransformer;

class MasterController extends Controller
{
    protected $repository;

    public function __construct(MasterRepository $repository)
    {
        $this->repository = $repository;
    }

    public function profile()
    {
        $master = $this->repository->getMasterInfo();

        return $this->response->item($master, new MasterTransformer);
    }
}
