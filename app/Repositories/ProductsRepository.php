<?php

namespace App\Repositories;

use App\Repositories\Contracts\ProductsRepositoryInterface;
use Illuminate\Support\Facades\DB;

class ProductsRepository implements ProductsRepositoryInterface
{
    protected $table;

    public function __construct()
    {
        $this->table = 'products';
    }
    public function getProductByTenantId(string $idTenat, array $categories)
    {
        return DB::table($this->table)
                ->join('category_product', 'category_product.product_id', '=', 'products.id')
                ->join('categories', 'category_product.category_id', '=', 'categories.id')
                ->where('products.tenant_id', $idTenat)
                ->where('categories.tenant_id', $idTenat)
                ->where( function ($query) use($categories){

                    if($categories != []) $query->whereIn('categories.url', $categories);
                })
                ->get();
    }

    public function getProductByUrl(string $url)
    {
        
        return DB::table($this->table)->where('url', $url)->first();
    }


}