<?php

namespace App\Infrastructure\Persistence\Eloquent\QueryBuilder\Filters;

use App\Domain\Product\DTO\ProductSearchCriteriaDto;
use Closure;
use Illuminate\Database\Eloquent\Builder;

class FilterByPriceRange
{
    public function __construct(protected ProductSearchCriteriaDto $criteria)
    {
    }

    public function handle(Builder $builder, Closure $next)
    {
        if ($this->criteria->priceFrom) {
            $builder->where('price', '>=', $this->criteria->priceFrom);
        }
        if ($this->criteria->priceTo) {
            $builder->where('price', '<=', $this->criteria->priceTo);
        }

        return $next($builder);
    }
}
