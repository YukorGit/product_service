<?php

namespace App\Domain\Product\Entity;

use App\Domain\Category\Entity\Category;
use InvalidArgumentException;
use DateTimeImmutable;

class Product
{
    public function __construct(
        public readonly int $id,
        public string $name,
        float $price,
        public Category $category,
        public bool $inStock,
        public float $rating,
        public ?DateTimeImmutable $createdAt = null,
        public ?DateTimeImmutable $updatedAt = null,
    ) {
        $this->price = $price;
    }

    public float $price {
        set (float $value) {
            if ($value < 0) {
                throw new InvalidArgumentException("Товар не может стоить меньше 0. Получено: {$value}");
            }
            $this->price = $value;
        }
        get => $this->price;
    }

    /**
     * Можно ли продать товар
     */
    public function isAvailableForPurchase(): bool
    {
        return $this->inStock && $this->price > 0;
    }
}
