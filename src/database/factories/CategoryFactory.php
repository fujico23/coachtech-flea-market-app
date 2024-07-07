<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

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
            'name' => $this->faker->word,
            'parent_id' => function () {
                if (rand(0, 1)) {
                    return null;
                } else {
                    return Category::inRandomOrder()->first()->id ?? null;
                }
            }
            //$this->faker->optional()->randomDigit,
        ];
    }
}
