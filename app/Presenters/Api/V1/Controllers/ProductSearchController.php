<?php

namespace App\Presenters\Api\V1\Controllers;

use App\Application\Product\GetProductListService;
use App\Infrastructure\Framework\Http\Controllers\Controller;
use App\Presenters\Api\V1\Requests\ProductSearchRequest;
use App\Presenters\Api\V1\Resources\ProductResource;
use Illuminate\Pagination\LengthAwarePaginator;
use OpenApi\Attributes as OA;

class ProductSearchController extends Controller
{
    #[OA\Get(
        path: "/api/products",
        operationId: "getProductsList",
        description: "Возвращает список товаров с пагинацией, фильтрацией и сортировкой.",
        summary: "Поиск товаров",
        tags: ["Products"]
    )]
    #[OA\Parameter(
        name: "q",
        description: "Поиск по названию (LIKE)",
        in: "query",
        required: false,
        schema: new OA\Schema(type: "string")
    )]
    #[OA\Parameter(
        name: "category_id",
        description: "ID категории",
        in: "query",
        required: false,
        schema: new OA\Schema(type: "integer")
    )]
    #[OA\Parameter(
        name: "price_from",
        description: "Цена от",
        in: "query",
        required: false,
        schema: new OA\Schema(type: "number", format: "float")
    )]
    #[OA\Parameter(
        name: "price_to",
        description: "Цена до",
        in: "query",
        required: false,
        schema: new OA\Schema(type: "number", format: "float")
    )]
    #[OA\Parameter(
        name: "in_stock",
        description: "Только в наличии (1 - да, 0 - нет)",
        in: "query",
        required: false,
        schema: new OA\Schema(type: "boolean")
    )]
    #[OA\Parameter(
        name: "rating_from",
        description: "Рейтинг от (0-5)",
        in: "query",
        required: false,
        schema: new OA\Schema(type: "number", format: "float")
    )]
    #[OA\Parameter(
        name: "sort",
        description: "Сортировка",
        in: "query",
        required: false,
        schema: new OA\Schema(
            type: "string",
            default: "newest",
            enum: ["price_asc", "price_desc", "rating_desc", "newest"]
        )
    )]
    #[OA\Parameter(
        name: "page",
        description: "Номер страницы",
        in: "query",
        required: false,
        schema: new OA\Schema(type: "integer", default: 1)
    )]
    #[OA\Parameter(
        name: "per_page",
        description: "Кол-во товаров на страницу",
        in: "query",
        required: false,
        schema: new OA\Schema(type: "integer", default: 15)
    )]
    #[OA\Response(
        response: 200,
        description: "Успешный ответ",
        content: new OA\JsonContent(
            properties: [
                new OA\Property(
                    property: "data",
                    type: "array",
                    items: new OA\Items(ref: "#/components/schemas/ProductResource")
                ),
                new OA\Property(
                    property: "links",
                    properties: [
                        new OA\Property(property: "first", type: "string", nullable: true),
                        new OA\Property(property: "last", type: "string", nullable: true),
                        new OA\Property(property: "prev", type: "string", nullable: true),
                        new OA\Property(property: "next", type: "string", nullable: true),
                    ],
                    type: "object"
                ),
                new OA\Property(
                    property: "meta",
                    properties: [
                        new OA\Property(property: "current_page", type: "integer"),
                        new OA\Property(property: "from", type: "integer"),
                        new OA\Property(property: "last_page", type: "integer"),
                        new OA\Property(property: "path", type: "string"),
                        new OA\Property(property: "per_page", type: "integer"),
                        new OA\Property(property: "to", type: "integer"),
                        new OA\Property(property: "total", type: "integer"),
                    ],
                    type: "object"
                ),
            ]
        )
    )]
    #[OA\Response(
        response: 422,
        description: "Ошибка валидации",
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: "message", type: "string", example: "The category id field is invalid."),
                new OA\Property(property: "errors", type: "object")
            ]
        )
    )]
    public function index(ProductSearchRequest $request, GetProductListService $service): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $result = $service->execute($request->toDto());

        $laravelPaginator = new LengthAwarePaginator(
            $result->items->all(),
            $result->total,
            $result->perPage,
            $result->currentPage,
            [
                'path' => $request->url(),
                'query' => $request->query(),
            ]
        );

        return ProductResource::collection($laravelPaginator);
    }
}
