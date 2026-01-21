<?php

namespace App\Infrastructure\Persistence\Eloquent\QueryBuilder\Filters;

use App\Infrastructure\Persistence\Eloquent\QueryBuilder\ProductSearchContext;
use Closure;

class FilterByCategory
{
    public function handle(ProductSearchContext $context, Closure $next)
    {
        if ($context->criteria->categoryId) {
            $context->builder->where('category_id', $context->criteria->categoryId);
        }

        return $next($context);
    }
}
