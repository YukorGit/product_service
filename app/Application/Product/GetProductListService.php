<?php

namespace App\Application\Product;

use App\Domain\Product\DTO\ProductSearchCriteriaDto;
use App\Domain\Product\Repository\ProductRepositoryInterface;
use App\Domain\Shared\DTO\PaginatedResult;

class GetProductListService
{
    public function __construct(
        protected ProductRepositoryInterface $repository
    ) {}

    public function execute(ProductSearchCriteriaDto $criteria): PaginatedResult
    {
        return $this->repository->search($criteria);
    }
}
