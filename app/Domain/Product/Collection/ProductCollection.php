<?php

namespace App\Domain\Product\Collection;

use App\Domain\Product\Entity\Product;
use ArrayIterator;
use Countable;
use IteratorAggregate;
use TypeError;

/**
 * Типизированная коллекция продуктов.
 */
class ProductCollection implements IteratorAggregate, Countable
{
    /** @var Product[] */
    private array $items = [];

    public function __construct(iterable $products = [])
    {
        foreach ($products as $product) {
            $this->add($product);
        }
    }

    public function add(Product $product): void
    {
        $this->items[] = $product;
    }

    /**
     * @return ArrayIterator<int, Product>
     */
    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->items);
    }

    public function count(): int
    {
        return count($this->items);
    }

    /**
     * @return Product[]
     */
    public function all(): array
    {
        return $this->items;
    }
}
