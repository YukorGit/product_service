<?php

namespace App\Presenters\Api\V1\Requests;

use App\Domain\Product\DTO\ProductSearchCriteriaDto;
use Illuminate\Foundation\Http\FormRequest;

class ProductSearchRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'q' => ['nullable', 'string', 'max:255'],
            'category_id' => ['nullable', 'integer', 'exists:categories,id'],
            'price_from' => ['nullable', 'numeric', 'min:0'],
            'price_to' => ['nullable', 'numeric', 'min:0'],
            'in_stock' => ['nullable', 'boolean'],
            'rating_from' => ['nullable', 'numeric', 'min:0', 'max:5'],
            'page' => ['nullable', 'integer', 'min:1'],
            'per_page' => ['nullable', 'integer', 'min:1', 'max:100'],
            'sort' => ['nullable', 'string', 'in:price_asc,price_desc,rating_desc,newest'],
        ];
    }

    public function toDto(): ProductSearchCriteriaDto
    {
        $sortParam = $this->input('sort', 'newest');

        [$sortBy, $sortDir] = match ($sortParam) {
            'price_asc' => ['price', 'asc'],
            'price_desc' => ['price', 'desc'],
            'rating_desc' => ['rating', 'desc'],
            default => ['created_at', 'desc'],
        };

        return new ProductSearchCriteriaDto(
            search: $this->input('q'),
            categoryId: $this->input('category_id'),
            priceFrom: $this->input('price_from'),
            priceTo: $this->input('price_to'),
            inStock: $this->boolean('in_stock', null),
            ratingFrom: $this->input('rating_from'),
            page: $this->integer('page', 1),
            perPage: $this->integer('per_page', 15),
            sortBy: $sortBy,
            sortDirection: $sortDir
        );
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
