<?php

namespace Database\Factories;

use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class OrderFactory extends Factory
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
            'identify' => $this->faker->uniqid . Str::random(10),
            'total' => 80.00,
            'status' => 'open',
            ''
        ];
    }
}
