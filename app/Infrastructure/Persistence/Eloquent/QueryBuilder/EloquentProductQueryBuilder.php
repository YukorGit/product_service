<?php

namespace App\Infrastructure\Persistence\Eloquent\QueryBuilder;

use App\Domain\Product\DTO\ProductSearchCriteriaDto;
use App\Infrastructure\Persistence\Eloquent\Models\ProductModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pipeline\Pipeline;

class EloquentProductQueryBuilder
{
    public function __construct(
        protected Pipeline $pipeline,
        protected ProductSorter $sorter,
        protected array $filters
    ) {}

    public function build(ProductModel $model, ProductSearchCriteriaDto $criteria): Builder
    {
        $query = $model->newQuery()->with('category');

        $context = new ProductSearchContext($query, $criteria);

        $this->pipeline
            ->send($context)
            ->through($this->filters)
            ->thenReturn();

        $this->sorter->apply($query, $criteria);

        return $query;
    }
}
