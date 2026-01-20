<?php

namespace App\Infrastructure\Persistence\Eloquent\QueryBuilder\Filters;

use App\Domain\Product\DTO\ProductSearchCriteriaDto;
use Closure;
use Illuminate\Database\Eloquent\Builder;

class FilterByName
{
    public function __construct(protected ProductSearchCriteriaDto $criteria) {}

    public function handle(Builder $builder, Closure $next)
    {
        if ($this->criteria->search) {
            $builder->where('name', 'like', '%' . $this->criteria->search . '%');
        }

        return $next($builder);
    }
}
