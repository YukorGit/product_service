<?php

namespace App\Infrastructure\Persistence\Eloquent\QueryBuilder\Filters;

use App\Domain\Product\DTO\ProductSearchCriteriaDto;
use Illuminate\Database\Eloquent\Builder;
use Closure;

class FilterByRating
{
    public function __construct(
        protected ProductSearchCriteriaDto $criteria
    ) {}

    public function handle(Builder $builder, Closure $next)
    {
        if ($this->criteria->ratingFrom !== null) {
            $builder->where('rating', '>=', $this->criteria->ratingFrom);
        }

        return $next($builder);
    }
}
