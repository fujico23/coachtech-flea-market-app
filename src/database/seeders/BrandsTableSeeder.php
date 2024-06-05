<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;
use App\Models\Category;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = Category::all();

        foreach ($categories as $category) {
            switch ($category->name) {
                case '家電':
                    Brand::create(['name' => 'Sony', 'category_id' => $category->id]);
                    Brand::create(['name' => 'Panasonic', 'category_id' => $category->id]);
                    Brand::create(['name' => 'Toshiba', 'category_id' => $category->id]);
                    Brand::create(['name' => 'Sharp', 'category_id' => $category->id]);
                    Brand::create(['name' => 'Hitachi', 'category_id' => $category->id]);
                    break;
                case 'ファッション':
                    Brand::create(['name' => 'Gucci', 'category_id' => $category->id]);
                    Brand::create(['name' => 'Prada', 'category_id' => $category->id]);
                    Brand::create(['name' => 'Louis Vuitton', 'category_id' => $category->id]);
                    Brand::create(['name' => 'Chanel', 'category_id' => $category->id]);
                    Brand::create(['name' => 'Hermes', 'category_id' => $category->id]);
                    break;
                case '書籍':
                    Brand::create(['name' => 'Penguin Books', 'category_id' => $category->id]);
                    Brand::create(['name' => 'HarperCollins', 'category_id' => $category->id]);
                    Brand::create(['name' => 'Simon & Schuster', 'category_id' => $category->id]);
                    Brand::create(['name' => 'Random House', 'category_id' => $category->id]);
                    Brand::create(['name' => 'Macmillan Publishers', 'category_id' => $category->id]);
                    break;
                case 'スポーツ用品':
                    Brand::create(['name' => 'Nike', 'category_id' => $category->id]);
                    Brand::create(['name' => 'Adidas', 'category_id' => $category->id]);
                    Brand::create(['name' => 'Under Armour', 'category_id' => $category->id]);
                    Brand::create(['name' => 'Puma', 'category_id' => $category->id]);
                    Brand::create(['name' => 'Reebok', 'category_id' => $category->id]);
                    break;
                case 'おもちゃ':
                    Brand::create(['name' => 'Lego', 'category_id' => $category->id]);
                    Brand::create(['name' => 'Mattel', 'category_id' => $category->id]);
                    Brand::create(['name' => 'Hasbro', 'category_id' => $category->id]);
                    Brand::create(['name' => 'Bandai', 'category_id' => $category->id]);
                    Brand::create(['name' => 'Fisher-Price', 'category_id' => $category->id]);
                    break;
                case '家具':
                    Brand::create(['name' => 'Ikea', 'category_id' => $category->id]);
                    Brand::create(['name' => 'Ashley Furniture', 'category_id' => $category->id]);
                    Brand::create(['name' => 'La-Z-Boy', 'category_id' => $category->id]);
                    Brand::create(['name' => 'Herman Miller', 'category_id' => $category->id]);
                    Brand::create(['name' => 'Steelcase', 'category_id' => $category->id]);
                    break;
                case 'アクセサリー':
                    Brand::create(['name' => 'Tiffany & Co.', 'category_id' => $category->id]);
                    Brand::create(['name' => 'Swarovski', 'category_id' => $category->id]);
                    Brand::create(['name' => 'Pandora', 'category_id' => $category->id]);
                    Brand::create(['name' => 'Cartier', 'category_id' => $category->id]);
                    Brand::create(['name' => 'Rolex', 'category_id' => $category->id]);
                    break;
                case '健康・美容':
                    Brand::create(['name' => 'L\'Oreal', 'category_id' => $category->id]);
                    Brand::create(['name' => 'Estee Lauder', 'category_id' => $category->id]);
                    Brand::create(['name' => 'Nivea', 'category_id' => $category->id]);
                    Brand::create(['name' => 'Neutrogena', 'category_id' => $category->id]);
                    Brand::create(['name' => 'Olay', 'category_id' => $category->id]);
                    break;
                case '音楽':
                    Brand::create(['name' => 'Yamaha', 'category_id' => $category->id]);
                    Brand::create(['name' => 'Fender', 'category_id' => $category->id]);
                    Brand::create(['name' => 'Gibson', 'category_id' => $category->id]);
                    Brand::create(['name' => 'Roland', 'category_id' => $category->id]);
                    Brand::create(['name' => 'Kawai', 'category_id' => $category->id]);
                    break;
                case 'アート':
                    Brand::create(['name' => 'Winsor & Newton', 'category_id' => $category->id]);
                    Brand::create(['name' => 'Faber-Castell', 'category_id' => $category->id]);
                    Brand::create(['name' => 'Royal & Langnickel', 'category_id' => $category->id]);
                    Brand::create(['name' => 'Sennelier', 'category_id' => $category->id]);
                    Brand::create(['name' => 'Liquitex', 'category_id' => $category->id]);
                    break;
            }
        }
    }
}
