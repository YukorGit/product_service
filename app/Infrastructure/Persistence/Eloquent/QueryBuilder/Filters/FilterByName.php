<?php

namespace App\Infrastructure\Persistence\Eloquent\QueryBuilder\Filters;

use App\Infrastructure\Persistence\Eloquent\QueryBuilder\ProductSearchContext;
use Closure;

class FilterByName
{
    public function handle(ProductSearchContext $context, Closure $next)
    {
        if ($context->criteria->search) {
            $context->builder->where('name', 'like', '%' . $context->criteria->search . '%');
        }

        return $next($context);
    }
}
