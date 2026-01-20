<?php

namespace Tests\Unit\Domain\Product\Entity;

use App\Domain\Product\Entity\Product;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\TestCase;
use Tests\Unit\Domain\Product\DataProviders\ProductAvailabilityDataProvider;

class ProductTest extends TestCase
{
    /**
     * Тест проверяет метод isAvailableForPurchase.
     * Данные (готовый объект Product) приходят из внешнего DataProvider.
     */
    #[DataProviderExternal(ProductAvailabilityDataProvider::class, 'provideScenarios')]
    public function test_product_availability_logic(Product $product, bool $expectedResult): void
    {
        // Act
        $actualResult = $product->isAvailableForPurchase();

        // Assert
        $this->assertSame(
            $expectedResult,
            $actualResult
        );
    }
}
