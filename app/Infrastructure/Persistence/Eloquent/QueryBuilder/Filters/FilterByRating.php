<?php

namespace App\Infrastructure\Persistence\Eloquent\QueryBuilder\Filters;

use App\Infrastructure\Persistence\Eloquent\QueryBuilder\ProductSearchContext;
use Closure;

class FilterByRating
{
    public function handle(ProductSearchContext $context, Closure $next)
    {
        if ($context->criteria->ratingFrom !== null) {
            $context->builder->where('rating', '>=', $context->criteria->ratingFrom);
        }

        return $next($context);
    }
}
