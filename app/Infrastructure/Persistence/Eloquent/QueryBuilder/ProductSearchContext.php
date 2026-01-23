<?php

namespace App\Infrastructure\Persistence\Eloquent\QueryBuilder;

use App\Domain\Product\DTO\ProductSearchCriteriaDto;
use Illuminate\Database\Eloquent\Builder;

class ProductSearchContext
{
    public function __construct(
        public Builder $builder,
        public readonly ProductSearchCriteriaDto $criteria
    ) {}
}
