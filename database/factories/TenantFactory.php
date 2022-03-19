<?php

namespace Database\Factories;

use App\Models\Plan;
use App\Models\Tenant;
use GuzzleHttp\Promise\Create;
use Illuminate\Database\Eloquent\Factories\Factory;

class TenantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'plan_id' => Plan::inRandomOrder()->first()->id,
            'cnpj' => $this->faker->unique()->numberBetween(1,16),
            'name' => $this->faker->unique()->name,
            'email' => $this->faker->unique()->safeEmail,

        ];
    }
}
