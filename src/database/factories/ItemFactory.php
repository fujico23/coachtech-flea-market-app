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
            'brand_id' => Brand::factory(),
            'price' => $this->faker->numberBetween(100, 100000),
            'description' => $this->faker->paragraph,
            'color_id' => Color::factory(),
            'category_id' => Category::factory(),
            'condition_id' => Condition::factory(),
        ];
    }
}
