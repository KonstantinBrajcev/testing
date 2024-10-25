<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;
    public function definition()
    {
        return [
            'sku' => $this->faker->unique()->word(),
            'name' => $this->faker->word(),
            'price' => $this->faker->randomFloat(3, 1, 1000),
        ];
    }
}
