<?php

namespace App\Domain\Shared\DTO;

use App\Domain\Product\Collection\ProductCollection;

readonly class PaginatedResult
{
    public function __construct(
        public ProductCollection $items,
        public int $total,
        public int $currentPage,
        public int $lastPage,
        public int $perPage
    ) {}
}
