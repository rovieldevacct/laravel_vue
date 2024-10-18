<?php

namespace Database\Factories;

use App\Models\ProductCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $category_id = ProductCategory::pluck('id');
        $created_by = User::where('access_control', 1)->pluck('id');
        return [
            'name' => fake()->sentence(3),
            'category_id' => fake()->randomElement($category_id),
            'description' => fake()->sentence(),
        ];
    }
}
