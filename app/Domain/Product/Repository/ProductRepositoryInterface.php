<?php

namespace App\Domain\Product\Repository;

use App\Domain\Product\DTO\ProductSearchCriteriaDto;
use App\Domain\Shared\DTO\PaginatedResult;

interface ProductRepositoryInterface
{
    public function search(ProductSearchCriteriaDto $criteria): PaginatedResult;
}
