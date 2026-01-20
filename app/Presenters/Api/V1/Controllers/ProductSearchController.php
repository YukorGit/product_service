<?php

namespace App\Presenters\Api\V1\Controllers;

use App\Application\Product\GetProductListService;
use App\Infrastructure\Framework\Http\Controllers\Controller;
use App\Presenters\Api\V1\Requests\ProductSearchRequest;
use App\Presenters\Api\V1\Resources\ProductResource;

class ProductSearchController extends Controller
{
    public function index(ProductSearchRequest $request, GetProductListService $service): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $products = $service->execute($request->toDto());

        return ProductResource::collection($products);
    }
}
