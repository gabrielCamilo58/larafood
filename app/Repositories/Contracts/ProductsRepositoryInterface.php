<?php 
namespace App\Repositories\Contracts;

interface ProductsRepositoryInterface
{
    public function getProductByTenantId(string $id, array $categories);
    public function getProductByUrl (string $url);
}