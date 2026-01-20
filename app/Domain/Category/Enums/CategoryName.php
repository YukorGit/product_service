<?php

namespace App\Domain\Category\Enums;

enum CategoryName: string
{
    case Electronics = 'Electronics';
    case Books = 'Books';
    case Clothing = 'Clothing';
    case Toys = 'Toys';
    case Furniture = 'Furniture';
}
