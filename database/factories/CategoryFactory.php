<?php

namespace Database\Factories;

use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'tenant_id' => $this->faker->factory(Tenant::class),
            'name' => $this->faker->unique()->name,
            'description' => $this->faker->sentence,
        ];
    }
}
