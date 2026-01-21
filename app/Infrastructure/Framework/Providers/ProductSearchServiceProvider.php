<?php

namespace App\Infrastructure\Framework\Providers;

use App\Infrastructure\Persistence\Eloquent\QueryBuilder\Filters\FilterByCategory;
use App\Infrastructure\Persistence\Eloquent\QueryBuilder\Filters\FilterByName;
use App\Infrastructure\Persistence\Eloquent\QueryBuilder\Filters\FilterByPriceRange;
use App\Infrastructure\Persistence\Eloquent\QueryBuilder\Filters\FilterByRating;
use App\Infrastructure\Persistence\Eloquent\QueryBuilder\Filters\FilterByStock;
use Illuminate\Support\ServiceProvider;

class ProductSearchServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind('product.search.filters', function () {
           return [
             FilterByName::class,
             FilterByCategory::class,
             FilterByPriceRange::class,
             FilterByRating::class,
             FilterByStock::class,
           ];
        });
    }
}
