<?php

namespace App\Infrastructure\Persistence\Eloquent\QueryBuilder;

use App\Domain\Product\DTO\ProductSearchCriteriaDto;
use Illuminate\Database\Eloquent\Builder;

class ProductSorter
{
    public function apply(Builder $builder, ProductSearchCriteriaDto $criteria): void
    {
        $builder->orderBy($criteria->sortBy, $criteria->sortDirection);
    }
}
