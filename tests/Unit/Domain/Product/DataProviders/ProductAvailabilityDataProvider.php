<?php

namespace Tests\Unit\Domain\Product\DataProviders;

use App\Domain\Category\Entity\Category;
use App\Domain\Category\Enums\CategoryName;
use App\Domain\Product\Entity\Product;

class ProductAvailabilityDataProvider
{
    /**
     * Возвращает набор сценариев: [Product entity, expectedResult]
     */
    public static function provideScenarios(): array
    {
        $category = new Category(
            id: 1,
            name: CategoryName::Electronics
        );

        return [
            'success: product in stock with price' => [
                new Product(
                    id: 1,
                    name: 'Iphone',
                    price: 999.99,
                    category: $category,
                    inStock: true,
                    rating: 5.0
                ),
                true
            ],
            'fail: product out of stock' => [
                new Product(
                    id: 2,
                    name: 'Old Nokia',
                    price: 50.00,
                    category: $category,
                    inStock: false,
                    rating: 4.5
                ),
                false
            ],
            'fail: product has zero price' => [
                new Product(
                    id: 3,
                    name: 'Free Gift',
                    price: 0.00,
                    category: $category,
                    inStock: true,
                    rating: 0.0
                ),
                false
            ],
            'fail: product has zero price and out of stock' => [
                new Product(
                    id: 4,
                    name: 'Ghost Item',
                    price: 0.00,
                    category: $category,
                    inStock: false,
                    rating: 0.0
                ),
                false
            ],
        ];
    }
}
