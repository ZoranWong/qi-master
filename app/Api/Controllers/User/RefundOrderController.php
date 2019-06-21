<?php

namespace App\Api\Controllers\User;

use App\Api\Controller;
use App\Repositories\RefundOrderRepository;

class RefundOrderController extends Controller
{
    protected $repository;

    public function __construct(RefundOrderRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * 我的退款记录
     */
    public function index()
    {

    }


}
