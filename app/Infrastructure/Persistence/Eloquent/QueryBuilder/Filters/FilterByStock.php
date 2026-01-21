<?php

namespace App\Infrastructure\Persistence\Eloquent\QueryBuilder\Filters;

use App\Infrastructure\Persistence\Eloquent\QueryBuilder\ProductSearchContext;
use Closure;

class FilterByStock
{

    public function handle(ProductSearchContext $context, Closure $next)
    {
        if ($context->criteria->inStock !== null) {
            $context->builder->where('in_stock', $context->criteria->inStock);
        }

        return $next($context);
    }
}
