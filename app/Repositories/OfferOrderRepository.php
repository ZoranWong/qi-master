<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface OfferOrderRepository.
 *
 * @package namespace App\Repositories;
 */
interface OfferOrderRepository extends RepositoryInterface
{
    public function getList();
}
