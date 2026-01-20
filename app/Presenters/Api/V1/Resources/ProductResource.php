<?php

namespace App\Presenters\Api\V1\Resources;

use App\Domain\Product\Entity\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property Product $resource
 */
class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        /** @var \App\Domain\Product\Entity\Product $product */
        $product = $this->resource;

        return [
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'in_stock' => $product->inStock,

            'category' => [
                'id' => $product->category->id,
                'name' => $product->category->name,
            ],

            'can_buy' => $product->isAvailableForPurchase(),
            'rating' => $product->rating,
            'created_at' => $product->createdAt?->format('Y-m-d'),
        ];
    }
}
