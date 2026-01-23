<?php

namespace App\Infrastructure\Persistence\Eloquent\Mappers;

use App\Domain\Category\Entity\Category;
use App\Domain\Category\Enums\CategoryName;
use App\Domain\Product\Collection\ProductCollection;
use App\Domain\Product\Entity\Product;
use App\Infrastructure\Persistence\Eloquent\Models\ProductModel;

class ProductMapper
{
    /**
     * Identity Map
     * [category_id => CategoryEntity]
     */
    private static array $categoryCache = [];

    /**
     * Преобразует модель Eloquent в доменную сущность
     */
    public static function toEntity(ProductModel $model): Product
    {
        $categoryId = $model->category->id;

        if (!isset(self::$categoryCache[$categoryId])) {
            self::$categoryCache[$categoryId] = new Category(
                id: $categoryId,
                name: CategoryName::from($model->category->name)
            );
        }

        $categoryEntity = self::$categoryCache[$categoryId];

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

    /**
     * Преобразует коллекцию моделей Eloquent в доменную коллекцию
     */
    public static function toCollection(iterable $models): ProductCollection
    {
        $collection = new ProductCollection();

        foreach ($models as $model) {
            $collection->add(self::toEntity($model));
        }

        return $collection;
    }
}
