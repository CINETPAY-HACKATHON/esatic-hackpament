<?php

namespace Database\Factories;

use Illuminate\Support\Str;
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
        $product_name = $this->faker->unique()->words($nb=4, $asText=true) ;
        $slug = Str::slug($product_name) ;
        return [
            'name' => $product_name,
            'slug' => $slug,
            'price' => 100,
            'image' => "digital_" . $this->faker->unique()->numberBetween(1,8) . ".jpg",
        ];
    }
}
