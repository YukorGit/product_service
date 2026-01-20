<?php

namespace App\Domain\Product\Repository;

use App\Domain\Product\DTO\ProductSearchCriteriaDto;

interface ProductRepositoryInterface
{
    public function search(ProductSearchCriteriaDto $criteria);
}
