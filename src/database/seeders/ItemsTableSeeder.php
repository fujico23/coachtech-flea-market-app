<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;
use Illuminate\Support\Str;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 30; $i++) {
            Item::create([
                'user_id' => rand(1, 3),
                'name' => Str::random(10),
                'brand_id' => rand(1, 51),
                'price' => rand(500, 20000),
                'description' => Str::random(50),
                'color_id' => rand(1, 12),
                'category_id' => rand(37, 171),
                'condition_id' => rand(1, 5),
            ]);
        }
    }
}
