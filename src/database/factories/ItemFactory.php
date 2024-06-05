<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Condition;
use App\Models\Item;

class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = Item::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'name' => $this->faker->word,
            'brand_id' => Brand::inRandomOrder()->first()->id,
            'price' => $this->faker->numberBetween(100, 100000),
            'description' => $this->faker->paragraph,
            'color_id' => Color::inRandomOrder()->first()->id,
            'category_id' => Category::inRandomOrder()->first()->id,
            'condition_id' => Condition::inRandomOrder()->first()->id,
        ];
    }
}
