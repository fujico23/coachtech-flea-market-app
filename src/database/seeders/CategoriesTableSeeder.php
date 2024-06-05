<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => '家電',
        ]);
        Category::create([
            'name' => 'ファッション',
        ]);
        Category::create([
            'name' => '書籍',
        ]);
        Category::create([
            'name' => 'スポーツ用品',
        ]);
        Category::create([
            'name' => 'おもちゃ',
        ]);
        Category::create([
            'name' => '家具',
        ]);
        Category::create([
            'name' => 'アクセサリー',
        ]);
        Category::create([
            'name' => '健康・美容',
        ]);
        Category::create([
            'name' => '音楽',
        ]);
        Category::create([
            'name' => 'アート',
        ]);
    }
}
