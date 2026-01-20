<?php

namespace App\Infrastructure\Persistence\Eloquent\Mappers;

use App\Domain\Category\Entity\Category;
use App\Domain\Category\Enums\CategoryName;
use App\Domain\Product\Entity\Product;
use App\Infrastructure\Persistence\Eloquent\Models\ProductModel;

class ProductMapper
{
    public static function toEntity(ProductModel $model): Product
    {
        $categoryEntity = new Category(
            id: $model->category->id,
            name: CategoryName::from($model->category->name)
        );

        return new Product(
            id: $model->id,
            name: $model->name,
            price: $model->price,
            category: $categoryEntity,
            inStock: $model->in_stock,
            rating: $model->rating,
            createdAt: $model->created_at?->toImmutable(),
            updatedAt: $model->updated_at?->toImmutable(),
        );
    }
}
