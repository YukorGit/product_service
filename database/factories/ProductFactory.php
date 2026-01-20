<?php

namespace Database\Factories;

use App\Infrastructure\Persistence\Eloquent\Models\ProductModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Infrastructure\Persistence\Eloquent\Models\ProductModel>
 */
class ProductFactory extends Factory
{
    protected $model = ProductModel::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => ucfirst($this->faker->words(2, true)),
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'in_stock' => $this->faker->boolean(80),
            'rating' => $this->faker->randomFloat(1, 0, 5),
        ];
    }
}
