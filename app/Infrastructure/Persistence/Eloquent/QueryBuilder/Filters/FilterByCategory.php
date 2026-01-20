<?php

namespace App\Infrastructure\Persistence\Eloquent\QueryBuilder\Filters;

use App\Domain\Product\DTO\ProductSearchCriteriaDto;
use Illuminate\Database\Eloquent\Builder;
use Closure;

class FilterByCategory
{
    public function __construct(
        protected ProductSearchCriteriaDto $criteria
    ) {}

    public function handle(Builder $builder, Closure $next)
    {
        if ($this->criteria->categoryId) {
            $builder->where('category_id', $this->criteria->categoryId);
        }

        return $next($builder);
    }
}
