<?php

namespace App\Infrastructure\Framework\Providers;

use App\Domain\Product\Repository\ProductRepositoryInterface;
use App\Infrastructure\Persistence\Eloquent\Models\ProductModel;
use App\Infrastructure\Persistence\Eloquent\QueryBuilder\EloquentProductQueryBuilder;
use App\Infrastructure\Persistence\Eloquent\QueryBuilder\Filters\FilterByCategory;
use App\Infrastructure\Persistence\Eloquent\QueryBuilder\Filters\FilterByName;
use App\Infrastructure\Persistence\Eloquent\QueryBuilder\Filters\FilterByPriceRange;
use App\Infrastructure\Persistence\Eloquent\QueryBuilder\Filters\FilterByRating;
use App\Infrastructure\Persistence\Eloquent\QueryBuilder\Filters\FilterByStock;
use App\Infrastructure\Persistence\Eloquent\QueryBuilder\ProductSorter;
use App\Infrastructure\Persistence\Eloquent\Repositories\EloquentProductRepository;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\ServiceProvider;

class ProductSearchServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(EloquentProductQueryBuilder::class, function ($app) {
            return new EloquentProductQueryBuilder(
                pipeline: $app->make(Pipeline::class),
                sorter: $app->make(ProductSorter::class),
                filters: [
                    FilterByName::class,
                    FilterByCategory::class,
                    FilterByPriceRange::class,
                    FilterByRating::class,
                    FilterByStock::class,
                ]
            );
        });

        $this->app->bind(ProductRepositoryInterface::class, function ($app) {
            return new EloquentProductRepository(
                model: new ProductModel(),
                queryBuilder: $app->make(EloquentProductQueryBuilder::class)
            );
        });
    }
}
