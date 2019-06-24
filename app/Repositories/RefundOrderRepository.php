<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface RefundOrderRepository.
 *
 * @package namespace App\Repositories;
 */
interface RefundOrderRepository extends RepositoryInterface
{
    public function getList();

}
