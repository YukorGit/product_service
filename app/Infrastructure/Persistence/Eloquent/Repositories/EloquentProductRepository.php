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
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Pipeline;

class EloquentProductRepository implements ProductRepositoryInterface
{
    public function search(ProductSearchCriteriaDto $criteria): LengthAwarePaginator
    {
        $query = ProductModel::query()->with('category');

        $query = Pipeline::send($query)
            ->through([
                new FilterByName($criteria),
                new FilterByCategory($criteria),
                new FilterByPriceRange($criteria),
                new FilterByStock($criteria),
                new FilterByRating($criteria),
            ])
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
