<?php

namespace App\Domain\Product\DTO;

readonly class ProductSearchCriteriaDto
{
    public function __construct(
        public ?string $search = null,
        public ?int $categoryId = null,
        public ?float $priceFrom = null,
        public ?float $priceTo = null,
        public ?bool $inStock = null,
        public ?float $ratingFrom = null,
        public int $page = 1,
        public int $perPage = 15,
        public string $sortBy = 'id',
        public string $sortDirection = 'desc'
    ) {}
}
