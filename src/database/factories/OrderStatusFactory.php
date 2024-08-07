<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OrderStatusFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->randomElement(['pending', 'unpaid', 'paid', 'shipped', 'completed', 'cancelled']),
            'description' => $this->faker->word,
        ];
    }
}
