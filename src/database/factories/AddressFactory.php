<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::faker(),
            'postal_code' => $this->faker->postcode,
            'address' => $this->faker->address,
            'building_name' => $this->faker->optional()->secondaryAddress,
            'type' => $this->faker->randomElement(['自宅', '会社', 'その他']),
            'is_default' => $this->faker->boolean,
        ];
    }
}
