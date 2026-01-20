<?php

namespace App\Infrastructure\Persistence\Eloquent\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Database\Factories\ProductFactory;

class ProductModel extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'category_id',
        'name',
        'price',
        'in_stock',
        'rating',
    ];

    protected $casts = [
        'price' => 'float',
        'in_stock' => 'boolean',
        'rating' => 'float',
    ];

    protected static function newFactory()
    {
        return ProductFactory::new();
    }

    /**
     * Связь с категорией.
     */
    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(CategoryModel::class, 'category_id');
    }
}
