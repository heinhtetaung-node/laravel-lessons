<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Products;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Products>
 */
class ProductsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Products::class;

    public function definition()
    {
        return [
            "name" => 'prd-'.$this->faker->word(),
            "price" => $this->faker->biasedNumberBetween(100,200),
            "cost" => $this->faker->biasedNumberBetween(10, 100),
            "desc" => $this->faker->paragraph(1)
        ];
    }
}
