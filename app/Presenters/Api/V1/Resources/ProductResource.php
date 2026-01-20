<?php

namespace App\Presenters\Api\V1\Resources;

use App\Domain\Product\Entity\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

/**
 * @property Product $resource
 */
#[OA\Schema(
    schema: "ProductResource",
    title: "Product",
    description: "Схема товара",
    required: ["id", "name", "price", "category"],
    properties: [
        new OA\Property(
            property: "id",
            description: "ID товара",
            type: "integer",
            example: 101
        ),
        new OA\Property(
            property: "name",
            description: "Название товара",
            type: "string",
            example: "Iphone 15"
        ),
        new OA\Property(
            property: "price",
            description: "Цена",
            type: "number",
            format: "float",
            example: 999.99
        ),
        new OA\Property(
            property: "in_stock",
            description: "Наличие на складе",
            type: "boolean",
            example: true
        ),
        new OA\Property(
            property: "category",
            description: "Категория товара",
            properties: [
                new OA\Property(property: "id", type: "integer", example: 5),
                new OA\Property(property: "name", type: "string", example: "Electronics"),
            ],
            type: "object"
        ),
        new OA\Property(
            property: "can_buy",
            description: "Доступен ли для покупки (бизнес-логика)",
            type: "boolean",
            example: true
        ),
        new OA\Property(
            property: "rating",
            description: "Рейтинг",
            type: "number",
            format: "float",
            example: 4.5
        ),
        new OA\Property(
            property: "created_at",
            description: "Дата создания",
            type: "string",
            format: "date",
            example: "2025-01-20"
        ),
    ]
)]
class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        /** @var Product $product */
        $product = $this->resource;

        return [
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'in_stock' => $product->inStock,
            'category' => [
                'id' => $product->category->id,
                'name' => $product->category->name->value,
            ],
            'can_buy' => $product->isAvailableForPurchase(),
            'rating' => $product->rating,
            'created_at' => $product->createdAt?->format('Y-m-d'),
        ];
    }
}
