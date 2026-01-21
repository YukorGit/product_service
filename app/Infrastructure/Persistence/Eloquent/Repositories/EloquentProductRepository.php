<?php

namespace App\Infrastructure\Persistence\Eloquent\Repositories;

use App\Domain\Product\DTO\ProductSearchCriteriaDto;
use App\Domain\Product\Repository\ProductRepositoryInterface;
use App\Infrastructure\Persistence\Eloquent\Models\ProductModel;
use App\Infrastructure\Persistence\Eloquent\Mappers\ProductMapper;
use App\Infrastructure\Persistence\Eloquent\QueryBuilder\Filters\FilterByCategory;
use App\Infrastructure\Persistence\Eloquent\QueryBuilder\Filters\FilterByName;
use App\Infrastructure\Persistence\Eloquent\QueryBuilder\Filters\FilterByPriceRange;
use App\Infrastructure\Persistence\Eloquent\QueryBuilder\Filters\FilterByRating;
use App\Infrastructure\Persistence\Eloquent\QueryBuilder\Filters\FilterByStock;
use App\Infrastructure\Persistence\Eloquent\QueryBuilder\ProductSearchContext;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Pipeline;

class EloquentProductRepository implements ProductRepositoryInterface
{
    protected array $filters;

    public function __construct()
    {
        $this->filters = app('product.search.filters');
    }

    public function search(ProductSearchCriteriaDto $criteria): LengthAwarePaginator
    {
        $query = ProductModel::query()->with('category');

        $context = new ProductSearchContext($query, $criteria);

        Pipeline::send($context)
            ->through($this->filters)
            ->thenReturn();

        $query->orderBy($criteria->sortBy, $criteria->sortDirection);

        $paginator = $query->paginate(
            perPage: $criteria->perPage,
            page: $criteria->page
        );

        $paginator->setCollection(
            $paginator->getCollection()->map(fn ($model) => ProductMapper::toEntity($model))
        );

        return $paginator;
    }
}
