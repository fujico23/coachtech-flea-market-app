<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Item;
use App\Models\OrderStatus;

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
            'user_id' => User::factory(),
            'item_id' => Item::factory(),
            'status' => OrderStatus::factory(),
            'pay_method' => $this->faker->randomElement(['card', 'konbini', 'customer_balance',]),
            'stripe_session_id' => $this->faker->paragraph,
        ];
    }
}
