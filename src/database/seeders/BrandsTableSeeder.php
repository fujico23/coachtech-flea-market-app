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
                    Brand::create(['name' => 'Sony',]);
                    Brand::create(['name' => 'Panasonic',]);
                    Brand::create(['name' => 'Toshiba',]);
                    Brand::create(['name' => 'Sharp',]);
                    Brand::create(['name' => 'Hitachi',]);
                    break;
                case 'ファッション':
                    Brand::create(['name' => 'Gucci',]);
                    Brand::create(['name' => 'Prada',]);
                    Brand::create(['name' => 'Louis Vuitton',]);
                    Brand::create(['name' => 'Chanel',]);
                    Brand::create(['name' => 'Hermes',]);
                    break;
                case '書籍':
                    Brand::create(['name' => 'Penguin Books',]);
                    Brand::create(['name' => 'HarperCollins',]);
                    Brand::create(['name' => 'Simon & Schuster',]);
                    Brand::create(['name' => 'Random House',]);
                    Brand::create(['name' => 'Macmillan Publishers',]);
                    break;
                case 'スポーツ用品':
                    Brand::create(['name' => 'Nike',]);
                    Brand::create(['name' => 'Adidas',]);
                    Brand::create(['name' => 'Under Armour',]);
                    Brand::create(['name' => 'Puma',]);
                    Brand::create(['name' => 'Reebok',]);
                    break;
                case 'おもちゃ':
                    Brand::create(['name' => 'Lego',]);
                    Brand::create(['name' => 'Mattel',]);
                    Brand::create(['name' => 'Hasbro',]);
                    Brand::create(['name' => 'Bandai',]);
                    Brand::create(['name' => 'Fisher-Price',]);
                    break;
                case '家具':
                    Brand::create(['name' => 'Ikea',]);
                    Brand::create(['name' => 'Ashley Furniture',]);
                    Brand::create(['name' => 'La-Z-Boy',]);
                    Brand::create(['name' => 'Herman Miller',]);
                    Brand::create(['name' => 'Steelcase',]);
                    break;
                case 'アクセサリー':
                    Brand::create(['name' => 'Tiffany & Co.',]);
                    Brand::create(['name' => 'Swarovski',]);
                    Brand::create(['name' => 'Pandora',]);
                    Brand::create(['name' => 'Cartier',]);
                    Brand::create(['name' => 'Rolex',]);
                    break;
                case '健康・美容':
                    Brand::create(['name' => 'L\'Oreal',]);
                    Brand::create(['name' => 'Estee Lauder',]);
                    Brand::create(['name' => 'Nivea',]);
                    Brand::create(['name' => 'Neutrogena',]);
                    Brand::create(['name' => 'Olay',]);
                    break;
                case '音楽':
                    Brand::create(['name' => 'Yamaha',]);
                    Brand::create(['name' => 'Fender',]);
                    Brand::create(['name' => 'Gibson',]);
                    Brand::create(['name' => 'Roland',]);
                    Brand::create(['name' => 'Kawai',]);
                    break;
                case 'アート':
                    Brand::create(['name' => 'Winsor & Newton',]);
                    Brand::create(['name' => 'Faber-Castell',]);
                    Brand::create(['name' => 'Royal & Langnickel',]);
                    Brand::create(['name' => 'Sennelier',]);
                    Brand::create(['name' => 'Liquitex',]);
                    break;
            }
        }
    }
}
