<?php

namespace App\Infrastructure\Persistence\Eloquent\QueryBuilder\Filters;

use App\Domain\Product\DTO\ProductSearchCriteriaDto;
use Illuminate\Database\Eloquent\Builder;
use Closure;

class FilterByStock
{
    public function __construct(
        protected ProductSearchCriteriaDto $criteria
    ) {}

    public function handle(Builder $builder, Closure $next)
    {
        if ($this->criteria->inStock !== null) {
            $builder->where('in_stock', $this->criteria->inStock);
        }

        return $next($builder);
    }
}
