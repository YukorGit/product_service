<?php

namespace App\Domain\Category\Entity;

use App\Domain\Category\Enums\CategoryName;

readonly class Category
{
    public function __construct(
        public int $id,
        public CategoryName $name
    ) {}
}
