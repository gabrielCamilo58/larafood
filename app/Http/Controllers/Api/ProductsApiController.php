<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TenantFormRequest;
use App\Http\Resources\ProductResource;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductsApiController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function productsByTenant(TenantFormRequest $request)
    {

        $products = $this->productService->getProductByTenantUuid($request->token_company, $request->get('categories', []));

        return response()->json($products);
        return ProductResource::collection($products);
    }

    public function show (TenantFormRequest $request, $uuid)
    {
        if(!$product = $this->productService->getProductByUuid($uuid))
        return response()->json(['message' => 'Produto não Encontrada'], 404);

        return new ProductResource($product);
    }
}
