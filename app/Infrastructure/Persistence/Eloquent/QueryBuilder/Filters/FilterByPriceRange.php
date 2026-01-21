<?php

namespace App\Infrastructure\Persistence\Eloquent\QueryBuilder\Filters;

use App\Infrastructure\Persistence\Eloquent\QueryBuilder\ProductSearchContext;
use Closure;

class FilterByPriceRange
{

    public function handle(ProductSearchContext $context, Closure $next)
    {
        if ($context->criteria->priceFrom) {
            $context->builder->where('price', '>=', $context->criteria->priceFrom);
        }
        if ($context->criteria->priceTo) {
            $context->builder->where('price', '<=', $context->criteria->priceTo);
        }

        return $next($context);
    }
}
