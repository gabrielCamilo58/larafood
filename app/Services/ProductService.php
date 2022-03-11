<?php

namespace App\Services;

use App\Repositories\Contracts\ProductsRepositoryInterface;
use App\Repositories\Contracts\TenantRepositoryInterface;

class ProductService
{
    protected $tenantRepository, $productService;
    public function __construct(ProductsRepositoryInterface $productService, TenantRepositoryInterface $tenantRepository)
    {
        $this->productService = $productService;
        $this->tenantRepository = $tenantRepository;
    }
    public function getProductByTenantUuid(string $uuid, array $categories)
    {
        $tenant = $this->tenantRepository->getTenantByUuid($uuid);
        
        return $this->productService->getProductByTenantId($tenant->id, $categories);
    }

    public function getProductByUrl(string $url)
    {
        return $this->productService->getProductByUrl($url);
    }
}