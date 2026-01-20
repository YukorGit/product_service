<?php

namespace App\Application\Product;

use App\Domain\Product\DTO\ProductSearchCriteriaDto;
use App\Domain\Product\Repository\ProductRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class GetProductListService
{
    public function __construct(
        protected ProductRepositoryInterface $repository
    ) {}

    public function execute(ProductSearchCriteriaDto $criteria): LengthAwarePaginator
    {
        return $this->repository->search($criteria);
    }
}
