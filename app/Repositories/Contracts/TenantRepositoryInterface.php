<?php

namespace App\Repositories\Contracts;

use PhpParser\Builder\Interface_;

Interface TenantRepositoryInterface
{

    public function getAllTenants(int $Perpage);
    public function getTenantByUuid(string $uuid);

}