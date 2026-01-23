<?php

namespace App\Infrastructure\Persistence\Eloquent\Repositories;

use App\Domain\Product\DTO\ProductSearchCriteriaDto;
use App\Domain\Product\Repository\ProductRepositoryInterface;
use App\Domain\Shared\DTO\PaginatedResult;
use App\Infrastructure\Persistence\Eloquent\Models\ProductModel;
use App\Infrastructure\Persistence\Eloquent\Mappers\ProductMapper;
use App\Infrastructure\Persistence\Eloquent\QueryBuilder\EloquentProductQueryBuilder;

class EloquentProductRepository implements ProductRepositoryInterface
{
    public function __construct(
        protected ProductModel $model,
        protected EloquentProductQueryBuilder $queryBuilder
    ) {}

    public function search(ProductSearchCriteriaDto $criteria): PaginatedResult
    {
        $query = $this->queryBuilder->build($this->model, $criteria);

        return $this->paginateAndMap($query, $criteria);
    }

    protected function paginateAndMap($query, ProductSearchCriteriaDto $criteria): PaginatedResult
    {
        $eloquentPaginator = $query->paginate(
            perPage: $criteria->perPage,
            page: $criteria->page
        );

        $domainCollection = ProductMapper::toCollection($eloquentPaginator->items());

        return new PaginatedResult(
            items: $domainCollection,
            total: $eloquentPaginator->total(),
            currentPage: $eloquentPaginator->currentPage(),
            lastPage: $eloquentPaginator->lastPage(),
            perPage: $eloquentPaginator->perPage()
        );
    }
}
