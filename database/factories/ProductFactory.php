<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'tenant_id' => Tenant::factory()->create(),
            'name' => $this->faker->unique()->name,
            'description' => $this->faker->sentence,
            'image' => 'pizza.png',
            'price' => 12.9,
        ];
    }
}
