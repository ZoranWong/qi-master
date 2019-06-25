<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface MasterRepository.
 *
 * @package namespace App\Repositories;
 */
interface MasterRepository extends RepositoryInterface
{
    public function getMasterInfo();
}
